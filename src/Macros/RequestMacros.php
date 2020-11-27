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
     * @return void
     */
    protected function registerIsUpdateMethod()
    {
        Request::macro('isUpdateMethod', function () {
            return in_array(Str::lower($this->method()), ['put', 'patch'], true);
        });
    }
}
