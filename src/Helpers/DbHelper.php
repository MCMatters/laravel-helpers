<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use Illuminate\Support\Arr;
use Throwable;

use function array_shift;
use function gettype;
use function implode;
use function is_string;
use function method_exists;
use function property_exists;
use function strlen;
use function str_replace;
use function trim;

use const false;
use const null;
use const true;

/**
 * Class DbHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class DbHelper
{
    /**
     * @param object|string $sql
     * @param array|null $bindings
     *
     * @return string
     */
    public static function compileSqlQuery(
        object|string $sql,
        ?array $bindings = [],
    ): string {
        if (!is_string($sql)) {
            $sqlQuery = $sql->toSql();

            if (empty($bindings)) {
                $bindings = self::getBindings($sql);
            }
        } else {
            $sqlQuery = $sql;
        }

        return self::replaceBindings($sqlQuery, $bindings ?: []);
    }

    /**
     * @param bool $withColumns
     * @param string|null $connection
     *
     * @return array
     */
    public static function getAllTables(
        bool $withColumns = true,
        ?string $connection = null,
    ): array {
        $tables = [];

        $db = self::getDb($connection);
        $schema = self::getSchema($connection);

        try {
            $schemas = (array) $db->getDoctrineSchemaManager()->listTableNames();
        } catch (Throwable) {
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
        ?string $connection = null,
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
                    "CONVERT(`{$column}` USING utf8) LIKE '%{$keyword}%'",
                );
            }

            foreach ($query->get() as $result) {
                $results[$table][] = $result;
            }
        }

        return $results;
    }

    /**
     * @param object $query
     *
     * @return object
     */
    public static function getBaseQuery(object $query): object
    {
        if (method_exists($query, 'getBaseQuery')) {
            return $query->getBaseQuery();
        }

        if (method_exists($query, 'getQuery')) {
            $query = $query->getQuery();
        } else {
            $query = clone $query;
        }

        if (method_exists($query, 'toBase')) {
            return $query->toBase();
        }

        return $query;
    }

    /**
     * @param object $query
     *
     * @return array
     */
    public static function getBindings(object $query): array
    {
        try {
            return $query->getBindings();
        } catch (Throwable) {
            $bindings = [];
        }

        $baseQuery = self::getBaseQuery($query);

        if (method_exists($baseQuery, 'getBindings')) {
            $bindings = $baseQuery->getBindings();
        } elseif (isset($baseQuery->bindings)) {
            $bindings = Arr::flatten($baseQuery->bindings);
        }

        return $bindings;
    }

    /**
     * @param object $query
     * @param string $with
     *
     * @return bool
     */
    public static function hasQueryJoinWith(object $query, string $with): bool
    {
        if (method_exists($query, 'getBaseQuery')) {
            $baseQuery = $query->getBaseQuery();
        } elseif (method_exists($query, 'getQuery')) {
            $baseQuery = $query->getQuery();
        } else {
            $baseQuery = clone $query;
        }

        if (!property_exists($baseQuery, 'joins')) {
            return false;
        }

        foreach ($baseQuery->joins ?? [] as $join) {
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
    protected static function transformSqlBinding(mixed $binding): float|int|string
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
        array $bindings = [],
    ): string {
        $previousPosition = 0;
        $offset = 0;
        $bindingPositions = StringHelper::occurrences($sql, '?');

        foreach ($bindings as $binding) {
            $binding = self::transformSqlBinding($binding);

            $position = array_shift($bindingPositions);
            $start = $offset + ($position - $previousPosition);
            $offset += ($position - $previousPosition) + strlen((string) $binding) - 1;
            $previousPosition = $position;

            $sql = substr_replace($sql, (string) $binding, $start, 1);
        }

        return $sql;
    }

    /**
     * @param float|int|string $string
     *
     * @return string
     */
    protected static function escapeString(float|int|string $string): string
    {
        return '"'.str_replace('\\', '\\\\\\', (string) $string).'"';
    }

    /**
     * @param string|null $connection
     *
     * @return mixed
     */
    protected static function getDb(?string $connection = null): mixed
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
    protected static function getSchema(?string $connection = null): mixed
    {
        return self::getDb($connection)->getSchemaBuilder();
    }
}
