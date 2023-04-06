<?php

declare(strict_types=1);

namespace McMatters\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use McMatters\Helpers\Macros\ArrMacros;
use McMatters\Helpers\Macros\CollectionMacros;
use McMatters\Helpers\Macros\RequestMacros;
use McMatters\Helpers\Macros\StrMacros;

use function is_callable;

class ServiceProvider extends BaseServiceProvider
{
    protected array $macros = [
        ArrMacros::class,
        CollectionMacros::class,
        RequestMacros::class,
        StrMacros::class,
    ];

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/laravel-helpers.php' => $this->getConfigPath(),
        ], 'config');

        $this->registerMacros();
        $this->registerHelperFunctions();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-helpers.php', 'laravel-helpers');
    }

    protected function registerMacros(): void
    {
        foreach ($this->macros as $macro) {
            (new $macro())->register();
        }
    }

    protected function registerHelperFunctions(): void
    {
        $files = Config::get('laravel-helpers.enabled_helper_functions', []);

        foreach ((array) $files as $file) {
            require __DIR__."/functions/{$file}.php";
        }
    }

    protected function getConfigPath(): string
    {
        if (is_callable([$this->app, 'configPath'])) {
            return $this->app->configPath('laravel-helpers.php');
        }

        return $this->app->basePath().'/config/laravel-helpers.php';
    }
}
