<?php

declare(strict_types=1);

use Illuminate\Http\Request;

if (!function_exists('is_request_method_update') && Request::hasMacro('isUpdateMethod')) {
    function is_request_method_update(Request $request = null): bool
    {
        return Request::isUpdateMethod($request);
    }
}
