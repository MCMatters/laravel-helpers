<?php

declare(strict_types=1);

use Illuminate\Http\Request;

if (!function_exists('is_request_method_update') && Request::hasMacro('isUpdateMethod')) {
    /**
     * @param \Illuminate\Http\Request|null $request
     *
     * @return bool
     */
    function is_request_method_update(Request $request = null): bool
    {
        return Request::isUpdateMethod($request);
    }
}
