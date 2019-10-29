<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Str;
use InvalidArgumentException;
use ReflectionClass;

use function get_class, is_object, is_string;

use const false, null;

/**
 * Class ClassHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ClassHelper
{
    /**
     * @param mixed $class
     *
     * @return array
     *
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     */
    public static function getConstants($class): array
    {
        $className = self::getClassName($class);

        if (null === $className) {
            throw new InvalidArgumentException('Passed wrong class object or class name');
        }

        $reflection = new ReflectionClass($className);

        return $reflection->getConstants();
    }

    /**
     * @param mixed $class
     * @param string $keyword
     * @param bool $substrKeyword
     *
     * @return array
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     */
    public static function getConstantsStartWith(
        $class,
        string $keyword,
        bool $substrKeyword = false
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
     * @param mixed $class
     *
     * @return string|null
     */
    public static function getClassName($class)
    {
        if (is_string($class)) {
            return $class;
        }

        if (is_object($class)) {
            return get_class($class);
        }

        return null;
    }
}
