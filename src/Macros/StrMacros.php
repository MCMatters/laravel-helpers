<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;
use function str_replace, ucwords;

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
}
