<?php

declare(strict_types = 1);

if (!function_exists('form_input_names')) {
    /**
     * @param string $key
     * @return string
     */
    function form_input_names(string $key): string
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }
}
