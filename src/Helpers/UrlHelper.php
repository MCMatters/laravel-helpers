<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;

use function parse_url;
use function preg_replace;
use function trim;

use const DIRECTORY_SEPARATOR;
use const false;
use const PHP_URL_HOST;
use const true;

class UrlHelper
{
    public static function getBaseUrl(string $url): string
    {
        $parsedUrl = parse_url($url);

        if (empty($parsedUrl['host'])) {
            return '';
        }

        $scheme = $parsedUrl['scheme'] ?? 'http';

        return "{$scheme}://{$parsedUrl['host']}";
    }

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

    public static function routesPath(string $path = ''): string
    {
        $basePath = Container::getInstance()->basePath();
        $routesPath = $basePath.DIRECTORY_SEPARATOR.'routes';

        return $path ? $routesPath.DIRECTORY_SEPARATOR.$path : $routesPath;
    }
}
