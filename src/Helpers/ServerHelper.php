<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Symfony\Component\HttpFoundation\Response;

use function array_filter, ini_get, ini_set, max, set_time_limit, stripos;

use const PHP_OS;

/**
 * Class ServerHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ServerHelper
{
    /**
     * @return void
     */
    public static function longProcesses()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
    }

    /**
     * @param string $type
     *
     * @return float|int
     */
    public static function getUploadMaxFilesize(string $type = 'mb')
    {
        return MathHelper::convertBytes(ini_get('upload_max_filesize'), $type);
    }

    /**
     * @param string $type
     *
     * @return float|int
     */
    public static function getPostMaxSize(string $type = 'b')
    {
        return MathHelper::convertBytes(ini_get('post_max_size'), $type);
    }

    /**
     * @return bool
     */
    public static function isMaxPostSizeExceeded(): bool
    {
        return $_SERVER['CONTENT_LENGTH'] > self::getPostMaxSize();
    }

    /**
     * @return int
     *
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     */
    public static function getMaxResponseCode(): int
    {
        $constants = ClassHelper::getConstantsStartWith(
            Response::class,
            'HTTP_'
        );

        return (int) max(array_filter($constants, 'is_numeric'));
    }

    /**
     * @return bool
     */
    public static function isWindowsOs(): bool
    {
        return 0 === stripos(PHP_OS, 'win');
    }
}
