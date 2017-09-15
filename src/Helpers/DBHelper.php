<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use InvalidArgumentException;
use const false, null, true;
use function gettype, implode, is_callable, is_object, is_string, preg_replace,
    property_exists, str_replace, trim;

/**
 * Class DBHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class DBHelper
{
    /**
     * @param mixed $sql
     * @param array|null $bindings
     *
     * @return string
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

        foreach ($bindings as $binding) {
            switch (gettype($binding)) {
                case 'boolean':
                case 'integer':
                    $binding = (int) $binding;
                    break;
                case 'float':
                case 'double':
                    $binding = (float) $binding;
                    break;
                case 'array':
                    foreach ($binding as $key => $value) {
                        $binding[$key] = self::escapeString($value);
                    }

                    $binding = implode(',', $binding);
                    break;
                case 'NULL':
                case 'unknown type':
                case 'resource':
                    break;
                case 'string':
                default:
                    $binding = self::escapeString($binding);
                    break;
            }
            $sql = preg_replace('/\?/', $binding, $sql, 1);
        }

        return $sql;
    }

    /**
     * @param bool $withColumns
     *
     * @return array
     */
    public static function getAllTables(bool $withColumns = true): array
    {
        $tables = [];

        $db = self::getDb();
        $schema = self::getSchema();

        foreach ($db->select('SHOW TABLES') as $tableInfo) {
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
     *
     * @return array
     */
    public static function searchEntireDatabase(string $keyword): array
    {
        $results = [];
        $keyword = trim($keyword);

        if ('' === $keyword) {
            return $results;
        }

        $db = self::getDb();

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
     * @param string|int|float $string
     *
     * @return string
     */
    protected static function escapeString($string): string
    {
        return '"'.str_replace('\\', '\\\\\\', (string) $string).'"';
    }

    /**
     * @return mixed
     */
    protected static function getDb()
    {
        static $db;

        if (null === $db) {
            $db = Container::getInstance()->make('db');
        }

        return $db;
    }

    /**
     * @return mixed
     */
    protected static function getSchema()
    {
        static $schema;

        if (null === $schema) {
            $schema = self::getDb()->connection()->getSchemaBuilder();
        }

        return $schema;
    }
}
