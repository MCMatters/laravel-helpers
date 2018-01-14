<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\ArtisanHelper;

if (!function_exists('get_php_path')) {
    /**
     * @return string
     * @throws RuntimeException
     */
    function get_php_path(): string
    {
        return ArtisanHelper::getPhpPath();
    }
}

if (!function_exists('get_artisan')) {
    /**
     * @return string
     */
    function get_artisan(): string
    {
        return ArtisanHelper::getArtisan();
    }
}

if (!function_exists('run_background_command')) {
    /**
     * @param string $command
     *
     * @return void
     * @throws RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    function run_background_command(string $command)
    {
        ArtisanHelper::runCommandInBackground($command);
    }
}
