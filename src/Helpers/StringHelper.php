<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use function str_replace;
use function ucwords;

use const false;

class StringHelper
{
    public static function ucwords(string $string): string
    {
        return ucwords(str_replace(['-', '_'], ' ', $string));
    }

    public static function occurrences(
        string $haystack,
        string $needle,
        bool $caseInsensitive = false,
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
