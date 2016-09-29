<?php

declare(strict_types = 1);

if (!function_exists('is_request_method_update')) {
    /**
     * @param null|Request $request
     * @return bool
     */
    function is_request_method_update($request = null): bool
    {
        /** @var Request $request */
        $request = $request ?: Request::instance();
        return in_array(
            Illuminate\Support\Str::lower($request->method()),
            ['put', 'patch'],
            true
        );
    }
}

if (!function_exists('is_production_environment')) {
    /**
     * Check if current environment is production.
     *
     * @return bool
     */
    function is_production_environment(): bool
    {
        return app()->environment('production', 'live');
    }
}

if (!function_exists('is_local_environment')) {
    /**
     * Check if current environment is local.
     *
     * @return bool
     */
    function is_local_environment(): bool
    {
        return app()->environment('local');
    }
}

if (!function_exists('long_processes')) {
    /**
     * Prepare for the long processes.
     */
    function long_processes()
    {
        set_time_limit(0);
        ini_set('memory_limit', '4096M');
    }
}

if (!function_exists('get_upload_max_filesize')) {
    /**
     * Get "upload_max_filesize" value from php.ini
     *
     * @param string $returnType
     * @return float|int
     */
    function get_upload_max_filesize(string $returnType = 'mb')
    {
        $sizeTypes = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
        $uploadMaxFileSize = ini_get('upload_max_filesize');
        $str = new \Illuminate\Support\Str();
        $returnType = $str::lower($returnType);
        $value = (int) $uploadMaxFileSize;
        $type = $str::lower($str::substr(
            $uploadMaxFileSize,
            $str::length($uploadMaxFileSize) - 1
        ));
        $type = $type === 'b' ? $type : $type.'b';
        if ($type === $returnType || !in_array($returnType, $sizeTypes, true)) {
            return $value;
        }
        $returnTypeKey = array_search($returnType, $sizeTypes, true);
        $typeKey = array_search($type, $sizeTypes, true);
        if ($returnTypeKey > $typeKey) {
            return $value / pow(1024, $returnTypeKey - $typeKey);
        } else {
            return $value * pow(1024, $typeKey - $returnTypeKey);
        }
    }
}
