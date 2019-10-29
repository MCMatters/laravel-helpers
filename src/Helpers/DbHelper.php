<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;

use function array_shift, gettype, implode, is_callable, is_object, is_string,
    property_exists, strlen, str_replace, trim;

use const false, null, true;

/**
 * Class DbHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class DbHelper
{
    /**
     * @param mixed $sql
     * @param array|null $bindings
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public static function compileSqlQuery($sql, array $bindings = null): string
    {
        if (!is_string($sql)) {
            if (!is_callable([$sql, 'toSql'])) {
                throw new InvalidArgumentException('"$sql" must be string or Query object.');
            }

            if (null === $bindings) {
                $bindings = $sql->getBindings();
            }

            $sql = $sql->toSql();
        }

       return self::replaceBindings($sql, $bindings);
    }

    /**
     * @param bool $withColumns
     * @param string|null $connection
     *
     * @return array
     */
    public static function getAllTables(
        bool $withColumns = true,
        string $connection = null
    ): array {
        $tables = [];

        $db = self::getDb($connection);
        $schema = self::getSchema($connection);

        try {
            $schemas = (array) $db->select('SHOW TABLES');
        } catch (Throwable $e) {
            return [];
        }

        foreach ($schemas as $tableInfo) {
            foreach ($tableInfo as $table) {
                if (!$withColumns) {
                    $tables[] = $table;
                } else {
                    foreach ($schema->getColumnListing($table) as $column) {
                        $tables[$table][] = $column;
                    }
                }
            }
        }

        return $tables;
    }

    /**
     * @param string $keyword
     * @param string|null $connection
     *
     * @return array
     */
    public static function searchEntireDatabase(
        string $keyword,
        string $connection = null
    ): array {
        $results = [];
        $keyword = trim($keyword);

        if ('' === $keyword) {
            return $results;
        }

        $db = self::getDb($connection);

        foreach (self::getAllTables() as $table => $columns) {
            $query = $db->table($table);

            foreach ($columns as $column) {
                $query->orWhereRaw(
                    "CONVERT(`{$column}` USING utf8) LIKE '%{$keyword}%'"
                );
            }

            foreach ($query->get() as $result) {
                $results[$table][] = $result;
            }
        }

        return $results;
    }

    /**
     * @param mixed $query
     * @param string $with
     *
     * @return bool
     */
    public static function hasQueryJoinWith($query, string $with): bool
    {
        if (!is_object($query)) {
            return false;
        }

        if (is_callable([$query, 'getBaseQuery'])) {
            $baseQuery = $query->getBaseQuery();
        } else {
            $baseQuery = clone $query;
        }

        if (!property_exists($baseQuery, 'joins')) {
            return false;
        }

        foreach ($baseQuery->joins as $join) {
            if ($join->table === $with) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param mixed $binding
     *
     * @return float|int|string
     */
    protected static function transformSqlBinding($binding)
    {
        switch (gettype($binding)) {
            case 'boolean':
            case 'integer':
                return (int) $binding;

            case 'float':
            case 'double':
                return (float) $binding;

            case 'array':
                foreach ($binding as $key => $value) {
                    $binding[$key] = self::transformSqlBinding($value);
                }

                return implode(',', $binding);

            case 'NULL':
            case 'unknown type':
            case 'resource':
                return '';
                break;

            case 'object':
            case 'string':
            default:
                return self::escapeString($binding);
        }
    }

    /**
     * @param string $sql
     * @param array $bindings
     *
     * @return string
     */
    protected static function replaceBindings(
        string $sql,
        array $bindings = []
    ): string {
        $previousPosition = 0;
        $offset = 0;
        $bindingPositions = Str::occurrences($sql, '?');

        foreach ($bindings as $binding) {
            $binding = self::transformSqlBinding($binding);

            $position = array_shift($bindingPositions);
            $start = $offset + ($position - $previousPosition);
            $offset += ($position - $previousPosition) + strlen((string) $binding) - 1;
            $previousPosition = $position;

            $sql = substr_replace($sql, $binding, $start, 1);
        }

        return $sql;
    }

    /**
     * @param string|int|float $string
     *
     * @return string
     */
    protected static function escapeString($string): string
    {
        return '"'.str_replace('\\', '\\\\\\', (string) $string).'"';
    }

    /**
     * @param string|null $connection
     *
     * @return mixed
     */
    protected static function getDb(string $connection = null)
    {
        static $db;

        if (null === $db) {
            $db = Container::getInstance()->make('db');
        }

        return $db->connection($connection);
    }

    /**
     * @param string|null $connection
     *
     * @return mixed
     */
    protected static function getSchema(string $connection = null)
    {
        return self::getDb($connection)->getSchemaBuilder();
    }
}
