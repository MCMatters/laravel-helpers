<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use const false, null, true;
use function array_key_exists, array_keys, array_slice, count, data_get,
    explode, implode, is_array, is_numeric, is_string, mb_strpos, preg_grep,
    preg_quote, shuffle;

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
    protected function registerHasWithWildcard()
    {
        Arr::macro(
            'hasWithWildcard',
            function (
                array $array,
                string $keys,
                bool $searchWithSegment = false
            ): bool {
                if (null === $keys || !$array) {
                    return false;
                }

                if (!Str::contains($keys, '*')) {
                    return static::has($array, $keys);
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

                    if ($searchWithSegment &&
                        $i !== ($countSegments - 1) &&
                        $segments[$i + 1] === '*'
                    ) {
                        $grepKeys = preg_grep(
                            '/'.preg_quote($segment, '/').'\..*/',
                            array_keys($array)
                        );

                        if ($grepKeys) {
                            foreach ($grepKeys as $grepKey) {
                                $flag = static::hasWithWildcard(
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
                                $flag = static::hasWithWildcard(
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
            }
        );
    }

    /**
     * @return void
     */
    protected function registerKeyBy()
    {
        Arr::macro('keyBy', function (array $array, string $key): array {
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
        Arr::macro(
            'contains',
            function (array $array, string $needle, bool $byKey = false): bool {
                foreach ($array as $key => $value) {
                    if ($byKey) {
                        if (mb_strpos($key, $needle) !== false) {
                            return true;
                        }
                    } else {
                        if (is_string($value) &&
                            mb_strpos($value, $needle) !== false
                        ) {
                            return true;
                        }
                    }
                }

                return false;
            }
        );
    }

    /**
     * @return void
     */
    protected function registerHasOnlyIntKeys()
    {
        Arr::macro('hasOnlyIntKeys', function (array $array): bool {
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
    protected function registerShuffleAssoc()
    {
        Arr::macro('shuffleAssoc', function (array $array): array {
            $shuffled = [];

            $keys = array_keys($array);
            shuffle($keys);

            foreach ($keys as $key) {
                $shuffled[$key] = $array[$key];
            }

            return $shuffled;
        });
    }
}
