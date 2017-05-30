<?php

declare(strict_types = 1);

if (!function_exists('transform_form_element_key')) {
    /**
     * Helper function for get the right name for the form element name.
     * "laravelcollective/html" uses similar method called "transformKey".
     * It helpful for Illuminate\Support\MessageBag when you want to get error
     * from the multiple field, for example from multiple phones.
     *
     * @param string $key
     *
     * @return string
     */
    function transform_form_element_key(string $key): string
    {
        return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
    }
}
