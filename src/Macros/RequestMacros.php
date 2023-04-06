<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function in_array;

use const true;

class RequestMacros extends AbstractMacroable
{
    protected function registerIsUpdateMethod(): void
    {
        Request::macro('isUpdateMethod', function (): bool {
            return in_array(Str::lower($this->method()), ['put', 'patch'], true);
        });
    }
}
