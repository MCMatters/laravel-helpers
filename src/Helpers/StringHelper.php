<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

/**
 * Class StringHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class StringHelper
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function ucwords(string $string): string
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
