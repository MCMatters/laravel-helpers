<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use InvalidArgumentException;
use ReflectionException;
use Symfony\Component\HttpFoundation\Response;
use const null, true;
use function in_array, ini_get, ini_set, max, set_time_limit;

/**
 * Class ServerHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ServerHelper
{
    /**
     * @param mixed $request
     *
     * @return bool
     */
    public static function isMethodUpdate($request = null): bool
    {
        $request = $request ?: Container::getInstance()->make('request');

        return in_array(Str::lower($request->method()), ['put', 'patch'], true);
    }

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
     * @throws ReflectionException
     * @throws InvalidArgumentException
     */
    public static function getMaxResponseCode(): int
    {
        $constants = ClassHelper::getConstantsStartWith(
            Response::class,
            'HTTP_'
        );

        return max($constants);
    }
}
