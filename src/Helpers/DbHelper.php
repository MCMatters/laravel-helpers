<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use DateTime;
use Illuminate\Container\Container;
use Illuminate\Support\Arr;
use Stringable;
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

class DbHelper
{
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

    protected static function transformSqlBinding(mixed $binding): float|int|string
    {
        switch (gettype($binding)) {
            case 'boolean':
            case 'integer':
                return (int) $binding;

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
                if (method_exists($binding, '__toString')) {
                    return self::escapeString((string) $binding);
                }

                if ($binding instanceof DateTime) {
                    return $binding->format('Y-m-d H:i:s');
                }

                return '';

            case 'string':
            default:
                return self::escapeString((string) $binding);
        }
    }

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

    protected static function escapeString(float|int|string|Stringable $string): string
    {
        return '"'.str_replace('\\', '\\\\\\', (string) $string).'"';
    }

    protected static function getDb(?string $connection = null): mixed
    {
        static $db;

        if (null === $db) {
            $db = Container::getInstance()->make('db');
        }

        return $db->connection($connection);
    }

    protected static function getSchema(?string $connection = null): mixed
    {
        return self::getDb($connection)->getSchemaBuilder();
    }
}
