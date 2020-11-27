<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Illuminate\Support\Str;
use ReflectionClass;

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
     * @return void
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
