<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\ArrayHelper;

if (!function_exists('array_has_with_wildcard')) {
    function array_has_with_wildcard(
        array $array,
        string $keys,
        bool $searchWithSegment = false,
    ): bool {
        return ArrayHelper::hasWithWildcard($array, $keys, $searchWithSegment);
    }
}

if (!function_exists('array_key_by')) {
    function array_key_by(array $array, string $key): array
    {
        return ArrayHelper::keyBy($array, $key);
    }
}

if (!function_exists('array_contains')) {
    function array_contains(
        array $array,
        string $needle,
        bool $byKey = false,
    ): bool {
        return ArrayHelper::contains($array, $needle, $byKey);
    }
}

if (!function_exists('array_has_only_int_keys')) {
    function array_has_only_int_keys(array $array): bool
    {
        return ArrayHelper::hasOnlyIntKeys($array);
    }
}

if (!function_exists('shuffle_assoc')) {
    function shuffle_assoc(array $array): array
    {
        return ArrayHelper::shuffleAssoc($array);
    }
}

if (!function_exists('array_change_key_case_recursive')) {
    function array_change_key_case_recursive(
        array $array,
        int $case = CASE_LOWER,
    ): array {
        return ArrayHelper::changeKeyCaseRecursive($array, $case);
    }
}
