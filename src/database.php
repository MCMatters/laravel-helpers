<?php

declare(strict_types = 1);

if (!function_exists('compile_sql_query')) {
    /**
     * Compile SQL query to string.
     *
     * @param string $sql
     * @param array $bindings
     * @return string
     */
    function compile_sql_query(string $sql, array $bindings = []): string
    {
        foreach ($bindings as $binding) {
            // TODO: need to review all cases.
            switch (gettype($binding)) {
                case 'boolean':
                case 'integer':
                    $binding = (int) $binding;
                    break;
                case 'string':
                default:
                    $binding = '"'.addslashes((string) $binding).'"';
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
     * @return array
     */
    function get_all_tables(): array
    {
        $tables = [];
        foreach (DB::select('SHOW TABLES') as $tableInfo) {
            foreach ($tableInfo as $table) {
                foreach (Schema::getColumnListing($table) as $column) {
                    $tables[$table][] = $column;
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
     * @param string $find
     *
     * @return array
     */
    function search_entire_database(string $find = ''): array
    {
        long_processes();
        $results = [];
        $find = trim($find);
        if ($find === '') {
            return $results;
        }
        foreach (get_all_tables() as $table => $columns) {
            $query = DB::table($table);
            foreach ($columns as $column) {
                $where = DB::raw('CONVERT(`'.$column.'` USING utf8) LIKE \'%'.$find.'%\'');
                $query->orWhereRaw($where);
            }
            foreach ($query->get() as $result) {
                $results[$table][] = $result;
            }
        }
        return $results;
    }
}
