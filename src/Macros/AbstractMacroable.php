<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

/**
 * Class AbstractMacroable
 *
 * @package McMatters\Helpers\Helpers
 */
abstract class AbstractMacroable
{
    /**
     * Auto registration of macros.
     *
     * @throws ReflectionException
     */
    public function register()
    {
        $reflection = new ReflectionClass(static::class);

        foreach ($reflection->getMethods() as $method) {
            $method = $method->getName();

            if ($method !== 'register' && Str::startsWith($method, 'register')) {
                $this->{$method}();
            }
        }
    }
}
