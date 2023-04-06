<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Arr;
use McMatters\Helpers\Helpers\ArrayHelper;

use const CASE_LOWER;
use const false;

class ArrMacros extends AbstractMacroable
{
    protected function registerFirstKey(): void
    {
        Arr::macro('firstKey', static function (array $array) {
            return ArrayHelper::firstKey($array);
        });
    }

    protected function registerHasWithWildcard(): void
    {
        Arr::macro('hasWithWildcard', static function (
            array $array,
            string $keys,
            bool $searchWithSegment = false,
        ): bool {
            return ArrayHelper::hasWithWildcard($array, $keys, $searchWithSegment);
        });
    }

    protected function registerKeyBy(): void
    {
        Arr::macro('keyBy', static function (array $array, string $key): array {
            return ArrayHelper::keyBy($array, $key);
        });
    }

    protected function registerContains(): void
    {
        Arr::macro('contains', static function (
            array $array,
            string $needle,
            bool $byKey = false,
        ): bool {
            return ArrayHelper::contains($array, $needle, $byKey);
        });
    }

    protected function registerHasOnlyIntKeys(): void
    {
        Arr::macro('hasOnlyIntKeys', static function (array $array): bool {
            return ArrayHelper::hasOnlyIntKeys($array);
        });
    }

    public function registerShuffleAssoc(): void
    {
        Arr::macro('shuffleAssoc', static function (array $array): array {
            return ArrayHelper::shuffleAssoc($array);
        });
    }

    protected function registerChangeKeyCaseRecursive(): void
    {
        Arr::macro('changeKeyCaseRecursive', static function (
            array $array,
            int $case = CASE_LOWER,
        ): array {
            return ArrayHelper::changeKeyCaseRecursive($array, $case);
        });
    }

    protected function registerHasValue(): void
    {
        Arr::macro('hasValue', static function (
            mixed $needle,
            array $array,
            bool $strict = false,
            bool $insensitive = false
        ): bool {
            return ArrayHelper::hasValue(
                $needle,
                $array,
                $strict,
                $insensitive,
            );
        });
    }
}
