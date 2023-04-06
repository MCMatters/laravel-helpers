<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\ArtisanHelper;

if (!function_exists('get_php_path')) {
    function get_php_path(): string
    {
        return ArtisanHelper::getPhpPath();
    }
}

if (!function_exists('get_artisan')) {
    function get_artisan(): string
    {
        return ArtisanHelper::getArtisan();
    }
}

if (!function_exists('run_background_command')) {
    function run_background_command(string $command, array $parameters = []): void
    {
        ArtisanHelper::runCommandInBackground($command, $parameters);
    }
}
