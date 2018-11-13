<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\TypeHelper;

if (!function_exists('random_bool')) {
    /**
     * @return bool
     */
    function random_bool(): bool
    {
        return TypeHelper::randomBool();
    }
}

if (!function_exists('casting_bool')) {
    /**
     * @param mixed $value
     * @param bool $default
     *
     * @return bool
     */
    function casting_bool($value, bool $default = false): bool
    {
        return TypeHelper::castingBool($value, $default);
    }
}

if (!function_exists('casting_nullable_bool')) {
    /**
     * @param mixed $value
     * @param bool $default
     *
     * @return bool|null
     */
    function casting_nullable_bool($value, bool $default = false): bool
    {
        return TypeHelper::castingNullableBool($value, $default);
    }
}

if (!function_exists('is_json')) {
    /**
     * @param mixed $json
     * @param bool $return
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     *
     * @return array|bool|stdClass
     */
    function is_json(
        $json,
        bool $return = false,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0
    ) {
        return TypeHelper::isJson($json, $return, $assoc, $depth, $options);
    }
}

if (!function_exists('is_uuid')) {
    /**
     * @param mixed $string
     *
     * @return bool
     */
    function is_uuid($string): bool
    {
        return TypeHelper::isUuid($string);
    }
}
