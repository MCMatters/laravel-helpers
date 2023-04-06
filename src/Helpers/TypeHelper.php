<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JsonException;
use stdClass;

use function in_array;
use function is_bool;
use function is_string;
use function json_decode;

use const false;
use const true;

class TypeHelper
{
    public static function randomBool(): bool
    {
        return Arr::random([true, false]);
    }

    /**
     * @param mixed $value
     * @param bool $default
     *
     * @return bool
     */
    public static function castingBool(mixed $value, bool $default = false): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        return match (Str::lower((string) $value)) {
            '1', 'true', 't', 'yes', 'y', 'on' => true,
            '0', 'false', 'f', 'no', 'n', 'off', '' => false,
            default => $default,
        };
    }

    public static function castingNullableBool(
        mixed $value,
        bool $default = false,
    ): ?bool {
        if (
            is_string($value) &&
            in_array(Str::lower($value), ['null', "'null'", '"null"'])
        ) {
            return null;
        }

        return static::castingBool($value, $default);
    }

    public static function isJson(
        mixed $json,
        bool $return = false,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0,
    ): bool|array|stdClass {
        if (!is_string($json)) {
            return false;
        }

        try {
            $decoded = json_decode(
                $json,
                $assoc,
                $depth,
                JSON_THROW_ON_ERROR | $options,
            );

            return $return ? $decoded : true;
        } catch (JsonException) {
            return false;
        }
    }
}
