<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use function parse_url;

/**
 * Class UrlHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class UrlHelper
{
    /**
     * @param string $url
     *
     * @return string
     */
    public static function getBaseUrl(string $url): string
    {
        $parsedUrl = parse_url($url);

        if (empty($parsedUrl['host'])) {
            return '';
        }

        $scheme = $parsedUrl['scheme'] ?? 'http';

        return $scheme.'://'.$parsedUrl['host'];
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public static function routesPath(string $path = ''): string
    {
        $basePath = Container::getInstance()->basePath();
        $routesPath = $basePath.DIRECTORY_SEPARATOR.'routes';

        return $path ? $routesPath.DIRECTORY_SEPARATOR.$path : $routesPath;
    }
}
