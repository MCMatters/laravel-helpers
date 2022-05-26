<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Str;
use ReflectionClass;

use function is_string;

use const false;

/**
 * Class ClassHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ClassHelper
{
    /**
     * @param object|string $class
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function getConstants(object|string $class): array
    {
        $className = self::getClassName($class);

        return (new ReflectionClass($className))->getConstants();
    }

    /**
     * @param object|string $class
     * @param string $keyword
     * @param bool $substrKeyword
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function getConstantsStartWith(
        object|string $class,
        string $keyword,
        bool $substrKeyword = false,
    ): array {
        $constants = [];

        foreach (self::getConstants($class) as $key => $constant) {
            if (Str::startsWith($key, $keyword)) {
                $key = $substrKeyword
                    ? Str::substr($key, Str::length($keyword))
                    : $key;

                $constants[$key] = $constant;
            }
        }

        return $constants;
    }

    /**
     * @param object|string $class
     *
     * @return string
     */
    public static function getClassName(object|string $class): string
    {
        if (is_string($class)) {
            return $class;
        }

        return $class::class;
    }
}
