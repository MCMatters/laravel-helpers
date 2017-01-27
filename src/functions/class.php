<?php

declare(strict_types = 1);

if (!function_exists('get_class_constants')) {
    /**
     * @param mixed $class
     * @return array
     * @throws Exception
     */
    function get_class_constants($class): array
    {
        $className = null;
        if (is_string($class)) {
            $className = $class;
        } elseif (is_object($class)) {
            $className = get_class($class);
        }
        if (null === $className) {
            throw new Exception('Passed wrong object class or class name');
        }
        $reflection = new ReflectionClass($className);
        return $reflection->getConstants();
    }
}

if (!function_exists('get_class_constants_start_with')) {
    /**
     * Get all class constants which start with $string.
     *
     * @param mixed $class
     * @param string $string
     *
     * @return array
     */
    function get_class_constants_start_with($class, string $string)
    {
        $constants = [];
        foreach (get_class_constants($class) as $key => $constant) {
            if (starts_with($key, $string)) {
                $constants[$key] = $constant;
            }
        }
        return $constants;
    }
}
