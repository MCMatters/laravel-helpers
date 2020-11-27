<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;

use function str_replace, ucwords;

use const false;

/**
 * Class StrMacros
 *
 * @package McMatters\Helpers\Macros
 */
class StrMacros extends AbstractMacroable
{
    /**
     * @return void
     */
    protected function registerUcwords()
    {
        Str::macro('ucwords', function (string $string) {
            return ucwords(str_replace(['-', '_'], ' ', $string));
        });
    }

    /**
     * @return void
     */
    protected function registerOccurrences()
    {
        Str::macro('occurrences', function (
            string $haystack,
            string $needle,
            bool $caseInsensitive = false
        ) {
            $occurrences = [];
            $offset = 0;

            $function = $caseInsensitive ? 'strpos' : 'stripos';

            while (($position = $function($haystack, $needle, $offset)) !== false) {
                $occurrences[] = $position;
                $offset = ++$position;
            }

            return $occurrences;
        });
    }
}
