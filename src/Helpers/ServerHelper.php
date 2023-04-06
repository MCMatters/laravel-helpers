<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Symfony\Component\HttpFoundation\Response;

use function array_filter;
use function ini_get;
use function ini_set;
use function max;
use function set_time_limit;
use function stripos;

use const PHP_OS_FAMILY;

class ServerHelper
{
    public static function longProcesses(int $memory = 4096): void
    {
        set_time_limit(0);
        ini_set('memory_limit', "{$memory}M");
    }

    public static function getUploadMaxFilesize(string $type = 'mb'): float|int
    {
        return MathHelper::convertBytes(ini_get('upload_max_filesize'), $type);
    }

    public static function getPostMaxSize(string $type = 'b'): float|int
    {
        return MathHelper::convertBytes(ini_get('post_max_size'), $type);
    }

    public static function isMaxPostSizeExceeded(): bool
    {
        return $_SERVER['CONTENT_LENGTH'] > self::getPostMaxSize();
    }

    /**
     * @throws \ReflectionException
     */
    public static function getMaxResponseCode(): int
    {
        $constants = ClassHelper::getConstantsStartWith(
            Response::class,
            'HTTP_',
        );

        return (int) max(array_filter($constants, 'is_numeric'));
    }

    public static function isWindowsOs(): bool
    {
        return 0 === stripos(PHP_OS_FAMILY, 'win');
    }
}
