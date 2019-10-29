<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;

use function parse_url, preg_replace, trim;

use const false, true, DIRECTORY_SEPARATOR, PHP_URL_HOST;

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

        return "{$scheme}://{$parsedUrl['host']}";
    }

    /**
     * @param string $url
     * @param bool $stripWww
     *
     * @return string
     */
    public static function getHost(string $url, bool $stripWww = true): string
    {
        if (($url = parse_url(trim($url), PHP_URL_HOST)) === false) {
            return '';
        }

        if ($stripWww) {
            return preg_replace('/^www\./', '', $url) ?? '';
        }

        return $url;
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
