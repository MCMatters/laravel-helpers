<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;
use McMatters\Helpers\Helpers\StringHelper;

use const false;

class StrMacros extends AbstractMacroable
{
    protected function registerUcwords(): void
    {
        Str::macro('ucwords', static function (string $string): string {
            return StringHelper::ucwords($string);
        });
    }

    protected function registerOccurrences(): void
    {
        Str::macro('occurrences', static function (
            string $haystack,
            string $needle,
            bool $caseInsensitive = false,
        ): array {
            return StringHelper::occurrences($haystack, $needle, $caseInsensitive);
        });
    }
}
