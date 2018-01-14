<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\ServerHelper;

if (!function_exists('long_processes')) {
    /**
     * @return void
     */
    function long_processes()
    {
        ServerHelper::longProcesses();
    }
}

if (!function_exists('get_upload_max_filesize')) {
    /**
     * @param string $type
     *
     * @return float|int
     */
    function get_upload_max_filesize(string $type = 'mb')
    {
        return ServerHelper::getUploadMaxFilesize($type);
    }
}

if (!function_exists('get_post_max_size')) {
    /**
     * @param string $type
     *
     * @return float|int
     */
    function get_post_max_size(string $type = 'b')
    {
        return ServerHelper::getPostMaxSize($type);
    }
}

if (!function_exists('is_max_post_size_exceeded')) {
    /**
     * @return bool
     */
    function is_max_post_size_exceeded(): bool
    {
        return ServerHelper::isMaxPostSizeExceeded();
    }
}

if (!function_exists('get_max_response_code')) {
    /**
     * @return int
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    function get_max_response_code(): int
    {
        return ServerHelper::getMaxResponseCode();
    }
}
