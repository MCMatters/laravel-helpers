<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use McMatters\Helpers\Helpers\StringHelper;

if (!function_exists('str_ucwords')) {
    function str_ucwords(string $string): string
    {
        return StringHelper::ucwords($string);
    }
}

if (!function_exists('str_lower')) {
    function str_lower(string $string): string
    {
        return Str::lower($string);
    }
}

if (!function_exists('str_upper')) {
    function str_upper(string $string): string
    {
        return Str::upper($string);
    }
}

if (!function_exists('strpos_all')) {
    function strpos_all(
        string $haystack,
        string $needle,
        bool $caseInsensitive = false,
    ): array {
        return StringHelper::occurrences($haystack, $needle, $caseInsensitive);
    }
}
