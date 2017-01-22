<?php

declare(strict_types = 1);

if (!function_exists('is_request_method_update')) {
    /**
     * @param null|Request $request
     * @return bool
     */
    function is_request_method_update($request = null): bool
    {
        /** @var Request $request */
        $request = $request ?: Request::instance();
        return in_array(
            Illuminate\Support\Str::lower($request->method()),
            ['put', 'patch'],
            true
        );
    }
}

if (!function_exists('long_processes')) {
    /**
     * Prepare for the long processes.
     */
    function long_processes()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
    }
}

if (!function_exists('get_upload_max_filesize')) {
    /**
     * Get "upload_max_filesize" value from php.ini
     *
     * @param string $returnType
     * @return float|int
     */
    function get_upload_max_filesize(string $returnType = 'mb')
    {
        return convert_bytes(ini_get('upload_max_filesize'), $returnType);
    }
}

if (!function_exists('get_post_max_size')) {
    /**
     * Get "post_max_size" value from php.ini
     *
     * @param string $returnType
     * @return float|int
     */
    function get_post_max_size(string $returnType = 'b')
    {
        return convert_bytes(ini_get('post_max_size'), $returnType);
    }
}

if (!function_exists('is_max_post_size_exceeded')) {
    /**
     * @return bool
     */
    function is_max_post_size_exceeded(): bool
    {
        return $_SERVER['CONTENT_LENGTH'] > get_post_max_size();
    }
}

if (!function_exists('get_max_response_code')) {
    /**
     * @return int
     */
    function get_max_response_code(): int
    {
        $constants = get_class_constants_start_with(
            Symfony\Component\HttpFoundation\Response::class,
            'HTTP_'
        );
        return max($constants);
    }
}
