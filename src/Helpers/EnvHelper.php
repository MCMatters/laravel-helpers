<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;

class EnvHelper
{
    public static function isProduction(): bool
    {
        return Container::getInstance()->environment('production', 'live');
    }

    public static function isStaging(): bool
    {
        return Container::getInstance()->environment('staging', 'stage');
    }

    public static function isLocal(): bool
    {
        return Container::getInstance()->environment('local');
    }

    public static function isTesting(): bool
    {
        return Container::getInstance()->environment('testing', 'test');
    }
}
