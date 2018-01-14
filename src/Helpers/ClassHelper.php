<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Str;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use const null;
use function get_class, is_object, is_string;

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
     * @throws ReflectionException
     * @throws InvalidArgumentException
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
     *
     * @return array
     * @throws ReflectionException
     * @throws InvalidArgumentException
     */
    public static function getConstantsStartWith($class, string $keyword): array
    {
        $constants = [];

        foreach (self::getConstants($class) as $key => $constant) {
            if (Str::startsWith($key, $keyword)) {
                $constants[$key] = $constant;
            }
        }

        return $constants;
    }

    /**
     * @param mixed $class
     *
     * @return null|string
     */
    public static function getClassName($class)
    {
        $name = null;

        if (is_string($class)) {
            $name = $class;
        } elseif (is_object($class)) {
            $name = get_class($class);
        }

        return $name;
    }
}
