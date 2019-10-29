<?php

declare(strict_types = 1);

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
     * @return string
     */
    public static function getClass(): string
    {
        return Str::class;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function registerUcwords(string $string): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $string));
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @param bool $caseInsensitive
     *
     * @return array
     */
    public function registerOccurrences(
        string $haystack,
        string $needle,
        bool $caseInsensitive = false
    ): array {
        $occurrences = [];
        $offset = 0;

        $function = $caseInsensitive ? 'strpos' : 'stripos';

        while (($position = $function($haystack, $needle, $offset)) !== false) {
            $occurrences[] = $position;
            $offset = ++$position;
        }

        return $occurrences;
    }
}
