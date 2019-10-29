<?php

declare(strict_types = 1);

namespace McMatters\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use McMatters\Helpers\Macros\{
    ArrMacros, CollectionMacros, RequestMacros, StrMacros
};

use function is_callable;

/**
 * Class ServiceProvider
 *
 * @package McMatters\Helpers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var array
     */
    protected $macros = [
        ArrMacros::class,
        CollectionMacros::class,
        RequestMacros::class,
        StrMacros::class,
    ];

    /**
     * @return void
     *
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-helpers.php' => $this->getConfigPath(),
        ], 'config');

        $this->registerMacros();
        $this->registerHelperFunctions();
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-helpers.php', 'laravel-helpers');
    }

    /**
     * @return void
     */
    protected function registerMacros()
    {
        foreach ($this->macros as $macro) {
            (new $macro())->register();
        }
    }

    /**
     * @return void
     */
    protected function registerHelperFunctions()
    {
        $files = Config::get('laravel-helpers.enabled_helper_functions');

        foreach ((array) $files as $file) {
            require __DIR__."/functions/{$file}.php";
        }
    }

    /**
     * @return string
     */
    protected function getConfigPath(): string
    {
        if (is_callable([$this->app, 'configPath'])) {
            return $this->app->configPath('laravel-helpers.php');
        }

        return $this->app->basePath().'/config/laravel-helpers.php';
    }
}
