<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\App;

if (!function_exists('is_production_environment')) {
    /**
     * Check if current environment is production.
     *
     * @return bool
     */
    function is_production_environment(): bool
    {
        return (bool) App::environment('production', 'live');
    }
}

if (!function_exists('is_local_environment')) {
    /**
     * Check if current environment is local.
     *
     * @return bool
     */
    function is_local_environment(): bool
    {
        return (bool) App::environment('local');
    }
}

if (!function_exists('get_size_types')) {
    /**
     * @return array
     */
    function get_size_types(): array
    {
        return ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
    }
}

if (!function_exists('random_bool')) {
    /**
     * @return bool
     */
    function random_bool(): bool
    {
        return (bool) random_int(0, 1);
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
        if (is_bool($value)) {
            return $value;
        }

        switch (str_lower((string) $value)) {
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
}

if (!function_exists('is_json')) {
    /**
     * @param string|mixed $json
     * @param bool $returnDecoded
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     *
     * @return bool|mixed
     */
    function is_json(
        $json,
        bool $returnDecoded = false,
        bool $assoc = false,
        int $depth = 512,
        int $options = 0
    ) {
        if (!is_string($json)) {
            return false;
        }

        $decoded = json_decode($json, $assoc, $depth, $options);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $returnDecoded ? $decoded : true;
        }

        return false;
    }
}

if (!function_exists('is_uuid')) {
    /**
     * @param string|mixed $string
     *
     * @return bool
     */
    function is_uuid($string): bool
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
