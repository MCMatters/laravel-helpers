<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\DbHelper;

if (!function_exists('compile_sql_query')) {
    function compile_sql_query(object|string $sql, ?array $bindings = null): string
    {
        return DbHelper::compileSqlQuery($sql, $bindings);
    }
}

if (!function_exists('get_all_tables')) {
    function get_all_tables(
        bool $withColumns = true,
        ?string $connection = null,
    ): array {
        return DbHelper::getAllTables($withColumns, $connection);
    }
}

if (!function_exists('search_entire_database')) {
    function search_entire_database(
        string $keyword,
        ?string $connection = null
    ): array {
        return DbHelper::searchEntireDatabase($keyword, $connection);
    }
}

if (!function_exists('has_query_join_with')) {
    function has_query_join_with(object $query, string $with): bool
    {
        return DbHelper::hasQueryJoinWith($query, $with);
    }
}
