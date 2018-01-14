<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Macros;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Illuminate\Support\Str;
use const true;
use function in_array;

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
     * @param Request|null $request
     *
     * @return bool
     */
    public function registerIsUpdateMethod(Request $request = null): bool
    {
        /** @var Request $request */
        $request = $request ?: RequestFacade::instance();

        return in_array(Str::lower($request->method()), ['put', 'patch'], true);
    }
}
