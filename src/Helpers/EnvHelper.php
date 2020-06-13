<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Container\Container;

/**
 * Class EnvHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class EnvHelper
{
    /**
     * @return bool
     */
    public static function isProduction(): bool
    {
        return Container::getInstance()->environment('production', 'live');
    }

    /**
     * @return bool
     */
    public static function isLocal(): bool
    {
        return Container::getInstance()->environment('local');
    }

    /**
     * @return bool
     */
    public static function isTesting(): bool
    {
        return Container::getInstance()->environment('testing');
    }
}
