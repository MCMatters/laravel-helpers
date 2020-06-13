<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function in_array;

use const true;

/**
 * Class RequestMacros
 *
 * @package McMatters\Helpers\Macros
 */
class RequestMacros extends AbstractMacroable
{
     /**
     * @return string
     */
    public static function getClass(): string
    {
        return Request::class;
    }

    /**
     * @return bool
     */
    public function registerIsUpdateMethod(): bool
    {
        return in_array(Str::lower($this->method()), ['put', 'patch'], true);
    }
}
