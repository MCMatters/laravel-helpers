<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\EnvHelper;

if (!function_exists('is_production_environment')) {
    function is_production_environment(): bool
    {
        return EnvHelper::isProduction();
    }
}

if (!function_exists('is_staging_environment')) {
    function is_staging_environment(): bool
    {
        return EnvHelper::isStaging();
    }
}

if (!function_exists('is_local_environment')) {
    function is_local_environment(): bool
    {
        return EnvHelper::isLocal();
    }
}

if (!function_exists('is_testing_environment')) {
    function is_testing_environment(): bool
    {
        return EnvHelper::isTesting();
    }
}
