<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

if (!function_exists('compile_sql_query')) {
    /**
     * Compile SQL query to string.
     *
     * @param string|mixed $sql
     * @param array|null $bindings
     *
     * @return string
     */
    function compile_sql_query($sql, array $bindings = null): string
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

        $toString = function ($string) {
            return '"'.str_replace('\\', '\\\\\\', (string) $string).'"';
        };

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
                        $binding[$key] = $toString($value);
                    }

                    $binding = implode(',', $binding);
                    break;
                case 'NULL':
                case 'unknown type':
                case 'resource':
                    break;
                case 'string':
                default:
                    $binding = $toString($binding);
                    break;
            }
            $sql = preg_replace('/\?/', $binding, $sql, 1);
        }

        return $sql;
    }
}

if (!function_exists('get_all_tables')) {
    /**
     * Get all tables.
     *
     * @param bool $withColumns
     *
     * @return array
     */
    function get_all_tables(bool $withColumns = true): array
    {
        $tables = [];

        foreach (DB::select('SHOW TABLES') as $tableInfo) {
            foreach ($tableInfo as $table) {
                if (!$withColumns) {
                    $tables[] = $table;
                } else {
                    foreach (Schema::getColumnListing($table) as $column) {
                        $tables[$table][] = $column;
                    }
                }
            }
        }

        return $tables;
    }
}

if (!function_exists('search_entire_database')) {
    /**
     * Search the entire database.
     *
     * @param string $keyword
     *
     * @return array
     */
    function search_entire_database(string $keyword): array
    {
        long_processes();
        $results = [];
        $keyword = trim($keyword);

        if ($keyword === '') {
            return $results;
        }

        foreach (get_all_tables() as $table => $columns) {
            $query = DB::table($table);

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
}

if (!function_exists('query_has_join')) {
    /**
     * @param mixed $query
     * @param string $table
     *
     * @return bool
     */
    function query_has_join($query, string $table): bool
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
            if ($join->table === $table) {
                return true;
            }
        }

        return false;
    }
}
