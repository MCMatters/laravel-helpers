<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\TypeHelper;

if (!function_exists('random_bool')) {
    function random_bool(): bool
    {
        return TypeHelper::randomBool();
    }
}

if (!function_exists('casting_bool')) {
    function casting_bool(mixed $value, bool $default = false): bool
    {
        return TypeHelper::castingBool($value, $default);
    }
}

if (!function_exists('casting_nullable_bool')) {
    function casting_nullable_bool(mixed $value, bool $default = false): ?bool
    {
        return TypeHelper::castingNullableBool($value, $default);
    }
}

if (!function_exists('is_json')) {
    function is_json(
        mixed $json,
        bool $return = false,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0,
    ): bool|array|stdClass {
        return TypeHelper::isJson($json, $return, $assoc, $depth, $options);
    }
}
