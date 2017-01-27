<?php

declare(strict_types = 1);

if (!function_exists('is_production_environment')) {
    /**
     * Check if current environment is production.
     *
     * @return bool
     */
    function is_production_environment(): bool
    {
        return app()->environment('production', 'live');
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
        return app()->environment('local');
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
