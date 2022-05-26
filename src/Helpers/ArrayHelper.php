<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use function array_key_first;
use function array_change_key_case;
use function array_key_exists;
use function array_keys;
use function array_map;
use function array_slice;
use function count;
use function data_get;
use function explode;
use function implode;
use function in_array;
use function is_array;
use function is_numeric;
use function is_string;
use function mb_strtolower;
use function preg_grep;
use function preg_quote;
use function shuffle;

use const CASE_LOWER;
use const false;
use const true;

/**
 * Class ArrayHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ArrayHelper
{
    /**
     * @param array $array
     *
     * @return int|string|null
     */
    public static function firstKey(array $array): int|string|null
    {
        return array_key_first($array);
    }

    /**
     * @param array $array
     * @param string $keys
     * @param bool $searchWithSegment
     *
     * @return bool
     */
    public static function hasWithWildcard(
        array $array,
        string $keys,
        bool $searchWithSegment = false,
    ): bool {
        if (!$array) {
            return false;
        }

        if (!Str::contains($keys, '*')) {
            return Arr::has($array, $keys);
        }

        $segments = explode('.', $keys);

        if ($segments === []) {
            return false;
        }

        $countSegments = count($segments);

        foreach ($segments as $i => $segment) {
            if (!is_array($array)) {
                return false;
            }

            $flag = false;

            if (
                $searchWithSegment &&
                $i !== ($countSegments - 1) &&
                $segments[$i + 1] === '*'
            ) {
                $grepKeys = preg_grep(
                    '/'.preg_quote($segment, '/').'\..*/',
                    array_keys($array),
                );

                if ($grepKeys) {
                    foreach ($grepKeys as $grepKey) {
                        $flag = self::hasWithWildcard(
                            $array[$grepKey],
                            implode('.', array_slice($segments, $i + 2)),
                            $searchWithSegment,
                        );

                        if ($flag) {
                            return true;
                        }
                    }

                    return false;
                }
            }

            if (!$flag) {
                if ($segment === '*') {
                    if ($i + 1 === $countSegments) {
                        return !empty($array);
                    }

                    foreach ($array as $item) {
                        $flag = self::hasWithWildcard(
                            $item,
                            implode('.', array_slice($segments, $i + 1)),
                            $searchWithSegment,
                        );

                        if ($flag) {
                            return true;
                        }
                    }

                    return false;
                }

                if (array_key_exists($segment, $array)) {
                    $flag = true;
                    $array = $array[$segment];
                }
            }

            if (!$flag) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $array
     * @param string $key
     *
     * @return array
     */
    public static function keyBy(array $array, string $key): array
    {
        $items = [];

        foreach ($array as $item) {
            $items[data_get($item, $key)] = $item;
        }

        return $items;
    }

    /**
     * @param array $array
     * @param string $needle
     * @param bool $byKey
     *
     * @return bool
     */
    public static function contains(
        array $array,
        string $needle,
        bool $byKey = false,
    ): bool {
        foreach ($array as $key => $value) {
            if ($byKey) {
                if (str_contains($key, $needle)) {
                    return true;
                }
            } elseif (
                is_string($value) &&
                str_contains($value, $needle)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $array
     *
     * @return bool
     */
    public static function hasOnlyIntKeys(array $array): bool
    {
        foreach ($array as $key => $value) {
            if (!is_numeric($key) || ((int) $key) != $key) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public static function shuffleAssoc(array $array): array
    {
        $shuffled = [];

        $keys = array_keys($array);
        shuffle($keys);

        foreach ($keys as $key) {
            $shuffled[$key] = $array[$key];
        }

        return $shuffled;
    }

    /**
     * @param array $array
     * @param int $case
     *
     * @return array
     */
    public static function changeKeyCaseRecursive(
        array $array,
        int $case = CASE_LOWER,
    ): array {
        foreach ($array as &$item) {
            if (is_array($item)) {
                $item = self::changeKeyCaseRecursive($item, $case);
            }
        }

        return array_change_key_case($array, $case);
    }

    /**
     * @param mixed $needle
     * @param array $array
     * @param bool $strict
     * @param bool $insensitive
     *
     * @return bool
     */
    public static function hasValue(
        mixed $needle,
        array $array,
        bool $strict = false,
        bool $insensitive = false,
    ): bool {
        if (!$insensitive || !is_string($needle)) {
            return in_array($needle, $array, $strict);
        }

        return in_array(
            mb_strtolower($needle, 'UTF-8'),
            array_map(
                static fn($value) => is_string($value)
                    ? mb_strtolower($value, 'UTF-8')
                    : $value,
                $array,
            ),
            $strict,
        );
    }
}
