<?php

declare(strict_types=1);

use Illuminate\Support\Arr;

if (!function_exists('array_key_first') && Arr::hasMacro('firstKey')) {
    /**
     * @param array $array
     *
     * @return int|string|null
     */
    function array_key_first(array $array)
    {
        return Arr::firstKey($array);
    }
}

if (!function_exists('array_has_with_wildcard') && Arr::hasMacro('hasWithWildcard')) {
    /**
     * @param array $array
     * @param string $keys
     * @param bool $searchWithSegment
     *
     * @return bool
     */
    function array_has_with_wildcard(
        array $array,
        string $keys,
        bool $searchWithSegment = false
    ): bool {
        return Arr::hasWithWildcard($array, $keys, $searchWithSegment);
    }
}

if (!function_exists('array_key_by') && Arr::hasMacro('keyBy')) {
    /**
     * @param array $array
     * @param string $key
     *
     * @return array
     */
    function array_key_by(array $array, string $key): array
    {
        return Arr::keyBy($array, $key);
    }
}

if (!function_exists('array_contains') && Arr::hasMacro('contains')) {
    /**
     * @param array $array
     * @param string $needle
     * @param bool $byKey
     *
     * @return bool
     */
    function array_contains(
        array $array,
        string $needle,
        bool $byKey = false
    ): bool {
        return Arr::contains($array, $needle, $byKey);
    }
}

if (!function_exists('array_has_only_int_keys') && Arr::hasMacro('hasOnlyIntKeys')) {
    /**
     * @param array $array
     *
     * @return bool
     */
    function array_has_only_int_keys(array $array): bool
    {
        return Arr::hasOnlyIntKeys($array);
    }
}

if (!function_exists('shuffle_assoc') && Arr::hasMacro('shuffleAssoc')) {
    /**
     * @param array $array
     *
     * @return array
     */
    function shuffle_assoc(array $array): array
    {
        return Arr::shuffleAssoc($array);
    }
}

if (!function_exists('array_change_key_case_recursive') && Arr::hasMacro('changeKeyCaseRecursive')) {
    /**
     * @param array $array
     * @param int $case
     *
     * @return array
     */
    function array_change_key_case_recursive(
        array $array,
        int $case = CASE_LOWER
    ): array {
        return Arr::changeKeyCaseRecursive($array, $case);
    }
}
