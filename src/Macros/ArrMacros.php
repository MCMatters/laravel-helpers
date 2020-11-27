<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use function array_change_key_case, array_key_exists, array_keys, array_slice,
    count, data_get, explode, implode, is_array, is_numeric, is_string,
    mb_strpos, preg_grep, preg_quote, shuffle;

use const false, null, true, CASE_LOWER;

/**
 * Class ArrMacros
 *
 * @package McMatters\Helpers\Macros
 */
class ArrMacros extends AbstractMacroable
{
    /**
     * @return void
     */
    protected function registerFirstKey()
    {
        Arr::macro('firstKey', function (array $array) {
            if (function_exists('array_key_first')) {
                return array_key_first($array);
            }

            foreach ($array as $key => $value) {
                return $key;
            }

            return null;
        });
    }

    /**
     * @return void
     */
    protected function registerHasWithWildcard()
    {
        Arr::macro('hasWithWildcard', function (
            array $array,
            string $keys,
            bool $searchWithSegment = false
        ) {
            if (null === $keys || !$array) {
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
                        array_keys($array)
                    );

                    if ($grepKeys) {
                        foreach ($grepKeys as $grepKey) {
                            $flag = Arr::hasWithWildcard(
                                $array[$grepKey],
                                implode('.', array_slice($segments, $i + 2)),
                                $searchWithSegment
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
                            $flag = Arr::hasWithWildcard(
                                $item,
                                implode('.', array_slice($segments, $i + 1)),
                                $searchWithSegment
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
        });
    }

    /**
     * @return void
     */
    protected function registerKeyBy()
    {
        Arr::macro('keyBy', function (array $array, string $key) {
            $items = [];

            foreach ($array as $item) {
                $items[data_get($item, $key)] = $item;
            }

            return $items;
        });
    }

    /**
     * @return void
     */
    protected function registerContains()
    {
        Arr::macro('contains', function (
            array $array,
            string $needle,
            bool $byKey = false
        ) {
            foreach ($array as $key => $value) {
                if ($byKey) {
                    if (mb_strpos($key, $needle) !== false) {
                        return true;
                    }
                } elseif (
                    is_string($value) &&
                    mb_strpos($value, $needle) !== false
                ) {
                    return true;
                }
            }

            return false;
        });
    }

    /**
     * @return void
     */
    protected function registerHasOnlyIntKeys()
    {
        Arr::macro('hasOnlyIntKeys', function (array $array) {
            foreach ($array as $key => $value) {
                if (!is_numeric($key) || (int) $key != $key) {
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * @return void
     */
    public function registerShuffleAssoc()
    {
        Arr::macro('shuffleAssoc', function (array $array) {
            $shuffled = [];

            $keys = array_keys($array);
            shuffle($keys);

            foreach ($keys as $key) {
                $shuffled[$key] = $array[$key];
            }

            return $shuffled;
        });
    }

    /**
     * @return void
     */
    protected function registerChangeKeyCaseRecursive()
    {
        Arr::macro('changeKeyCaseRecursive', function (
            array $array,
            int $case = CASE_LOWER
        ) {
            foreach ($array as &$item) {
                if (is_array($item)) {
                    $item = Arr::changeKeyCaseRecursive($item, $case);
                }
            }

            return array_change_key_case($array, $case);
        });
    }
}
