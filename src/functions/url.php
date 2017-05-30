<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\App;

if (!function_exists('get_base_url')) {
    /**
     * @param string $url
     * @return string
     */
    function get_base_url(string $url): string
    {
        $parsedUrl = parse_url($url);

        if (empty($parsedUrl['host'])) {
            return '';
        }

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
        $routesPath = App::basePath('routes');

        return $path ? "{$routesPath}/{$path}" : $routesPath;
    }
}
