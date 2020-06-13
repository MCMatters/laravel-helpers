<?php

declare(strict_types=1);

use Illuminate\Support\Str;

if (!function_exists('str_ucwords') && Str::hasMacro('ucwords')) {
    /**
     * @param string $string
     *
     * @return string
     */
    function str_ucwords(string $string): string
    {
        return Str::ucwords($string);
    }
}

if (!function_exists('str_lower')) {
    /**
     * @param string $string
     *
     * @return string
     */
    function str_lower(string $string): string
    {
        return Str::lower($string);
    }
}

if (!function_exists('str_upper')) {
    /**
     * @param string $string
     *
     * @return string
     */
    function str_upper(string $string): string
    {
        return Str::upper($string);
    }
}

if (!function_exists('strpos_all')) {
    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $caseInsensitive
     *
     * @return array
     */
    function strpos_all(
        string $haystack,
        string $needle,
        bool $caseInsensitive = false
    ): array {
        return Str::occurrences($haystack, $needle, $caseInsensitive);
    }
}
