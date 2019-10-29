<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\DbHelper;

if (!function_exists('compile_sql_query')) {
    /**
     * @param mixed $sql
     * @param array|null $bindings
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function compile_sql_query($sql, array $bindings = null): string
    {
        return DbHelper::compileSqlQuery($sql, $bindings);
    }
}

if (!function_exists('get_all_tables')) {
    /**
     * @param bool $withColumns
     * @param string|null $connection
     *
     * @return array
     */
    function get_all_tables(
        bool $withColumns = true,
        string $connection = null
    ): array {
        return DbHelper::getAllTables($withColumns, $connection);
    }
}

if (!function_exists('search_entire_database')) {
    /**
     * @param string $keyword
     * @param string|null $connection
     *
     * @return array
     */
    function search_entire_database(
        string $keyword,
        string $connection = null
    ): array {
        return DbHelper::searchEntireDatabase($keyword, $connection);
    }
}

if (!function_exists('has_query_join_with')) {
    /**
     * @param mixed $query
     * @param string $with
     *
     * @return bool
     */
    function has_query_join_with($query, string $with): bool
    {
        return DbHelper::hasQueryJoinWith($query, $with);
    }
}
