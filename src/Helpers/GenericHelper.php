<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;
use Illuminate\Support\Str;
use const false, true;
use function is_bool, is_string, json_decode, json_last_error, preg_match, random_int;

/**
 * Class GenericHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class GenericHelper
{
    /**
     * @return bool
     */
    public static function isProduction(): bool
    {
        return Container::getInstance()->environment('production', 'live');
    }

    /**
     * @return bool
     */
    public static function isLocal(): bool
    {
        return Container::getInstance()->environment('local');
    }

    /**
     * @return array
     */
    public static function getSizeTypes(): array
    {
        return ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
    }

    /**
     * @return bool
     */
    public static function randomBool(): bool
    {
        return (bool) random_int(0, 1);
    }

    /**
     * @param $value
     * @param bool $default
     *
     * @return bool
     */
    public static function castingBool($value, bool $default = false): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        switch (Str::lower((string) $value)) {
            case '1':
            case 'true':
            case 't':
                return true;
            case '0':
            case 'false':
            case 'f':
            case '':
                return false;
            default:
                return $default;
        }
    }

    /**
     * @param $json
     * @param bool $return
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     *
     * @return mixed
     */
    public static function isJson(
        $json,
        bool $return = false,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0
    ) {
        if (!is_string($json)) {
            return false;
        }

        $decoded = json_decode($json, $assoc, $depth, $options);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $return ? $decoded : true;
        }

        return false;
    }

    /**
     * @param mixed $string
     *
     * @return bool
     */
    public static function isUuid($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        return (bool) preg_match(
            '/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/',
            $string
        );
    }
}
