<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\UrlHelper;

if (!function_exists('get_base_url')) {
    function get_base_url(string $url): string
    {
        return UrlHelper::getBaseUrl($url);
    }
}

if (!function_exists('get_host_url')) {
    function get_host_url(string $url, bool $stripWww = true): string
    {
        return UrlHelper::getHost($url, $stripWww);
    }
}

if (!function_exists('routes_path')) {
    function routes_path(string $path = ''): string
    {
        return UrlHelper::routesPath($path);
    }
}
