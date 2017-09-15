<?php

declare(strict_types = 1);

namespace McMatters\Helpers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use McMatters\Helpers\Macros\ArrMacros;
use McMatters\Helpers\Macros\StrMacros;
use ReflectionException;

/**
 * Class ServiceProvider
 *
 * @package McMatters\Helpers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     * @throws ReflectionException
     */
    public function boot()
    {
        (new ArrMacros())->register();
        (new StrMacros())->register();
    }
}
