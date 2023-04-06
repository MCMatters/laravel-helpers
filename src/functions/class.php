<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\ClassHelper;

if (!function_exists('get_class_constants')) {
    /**
     * @throws \ReflectionException
     */
    function get_class_constants(object|string $class): array
    {
        return ClassHelper::getConstants($class);
    }
}

if (!function_exists('get_class_constants_start_with')) {
    /**
     * @throws \ReflectionException
     */
    function get_class_constants_start_with(
        object|string $class,
        string $keyword,
        bool $substrKeyword = false,
    ): array {
        return ClassHelper::getConstantsStartWith($class, $keyword, $substrKeyword);
    }
}
