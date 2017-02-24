<?php

declare(strict_types = 1);

if (!function_exists('str_lower')) {
    /**
     * Wrapper over Str::lower.
     *
     * @param string $string
     *
     * @return string
     */
    function str_lower(string $string): string
    {
        return \Illuminate\Support\Str::lower($string);
    }
}

if (!function_exists('str_upper')) {
    /**
     * Wrapper over Str::upper.
     *
     * @param string $string
     *
     * @return string
     */
    function str_upper(string $string): string
    {
        return \Illuminate\Support\Str::upper($string);
    }
}

if (!function_exists('str_ucwords')) {
    /**
     * Convert a value to studly caps case with spaces.
     *
     * @param string $string
     *
     * @return string
     */
    function str_ucwords(string $string): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $string));
    }
}

if (!function_exists('strpos_array')) {
    /**
     * Wrapper over "strpos".
     *
     * @param string $haystack
     * @param array|string $needles
     * @param int $offset
     *
     * @return bool|int|mixed
     */
    function strpos_array(string $haystack, $needles, int $offset = 0)
    {
        $position = false;
        foreach ((array) $needles as $needle) {
            $strpos = strpos($haystack, $needle, $offset);
            if ($strpos !== false) {
                $position = $position === false
                    ? $strpos
                    : min($strpos, $position);
            }
        }

        return $position;
    }
}
