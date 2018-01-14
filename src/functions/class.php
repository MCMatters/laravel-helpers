<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\ClassHelper;

if (!function_exists('get_class_constants')) {
    /**
     * @param mixed $class
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    function get_class_constants($class): array
    {
        return ClassHelper::getConstants($class);
    }
}

if (!function_exists('get_class_constants_start_with')) {
    /**
     * @param mixed $class
     * @param string $keyword
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    function get_class_constants_start_with($class, string $keyword): array
    {
        return ClassHelper::getConstantsStartWith($class, $keyword);
    }
}
