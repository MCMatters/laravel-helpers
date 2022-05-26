<?php

declare(strict_types=1);

use Illuminate\Support\Arr;
use McMatters\Helpers\Helpers\ArrayHelper;

if (!function_exists('array_has_with_wildcard')) {
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
        bool $searchWithSegment = false,
    ): bool {
        return ArrayHelper::hasWithWildcard($array, $keys, $searchWithSegment);
    }
}

if (!function_exists('array_key_by')) {
    /**
     * @param array $array
     * @param string $key
     *
     * @return array
     */
    function array_key_by(array $array, string $key): array
    {
        return ArrayHelper::keyBy($array, $key);
    }
}

if (!function_exists('array_contains')) {
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
        bool $byKey = false,
    ): bool {
        return ArrayHelper::contains($array, $needle, $byKey);
    }
}

if (!function_exists('array_has_only_int_keys')) {
    /**
     * @param array $array
     *
     * @return bool
     */
    function array_has_only_int_keys(array $array): bool
    {
        return ArrayHelper::hasOnlyIntKeys($array);
    }
}

if (!function_exists('shuffle_assoc')) {
    /**
     * @param array $array
     *
     * @return array
     */
    function shuffle_assoc(array $array): array
    {
        return ArrayHelper::shuffleAssoc($array);
    }
}

if (!function_exists('array_change_key_case_recursive')) {
    /**
     * @param array $array
     * @param int $case
     *
     * @return array
     */
    function array_change_key_case_recursive(
        array $array,
        int $case = CASE_LOWER,
    ): array {
        return ArrayHelper::changeKeyCaseRecursive($array, $case);
    }
}
