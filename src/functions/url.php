<?php

declare(strict_types = 1);

if (!function_exists('get_base_url')) {
    /**
     * @param string $url
     * @return string
     */
    function get_base_url(string $url): string
    {
        $parsedUrl = parse_url($url);

        $scheme = $parsedUrl['scheme'] ?? 'http';

        return $scheme.'://'.$parsedUrl['host'];
    }
}

if (!function_exists('routes_path')) {
    /**
     * @param string $path
     * @return string
     */
    function routes_path(string $path = ''): string
    {
        $routesPath = base_path('routes');

        return $path ? $routesPath.'/'.$path : $routesPath;
    }
}
