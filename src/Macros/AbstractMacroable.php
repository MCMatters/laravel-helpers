<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;
use ReflectionClass;

abstract class AbstractMacroable
{
    /**
     * Auto registration of macros.
     */
    public function register(): void
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
