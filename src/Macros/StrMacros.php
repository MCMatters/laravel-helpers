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
     * @return void
     */
    protected function registerUcwords()
    {
        Str::macro('ucwords', function (string $string): string {
            return ucwords(str_replace(['-', '_'], ' ', $string));
        });
    }
}
