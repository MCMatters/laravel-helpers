<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use RuntimeException;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;
use const ARTISAN_BINARY;
use function defined, stripos;

/**
 * Class ArtisanHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ArtisanHelper
{
    /**
     * @return string
     * @throws RuntimeException
     */
    public static function getPhpPath(): string
    {
        if (!$path = (new PhpExecutableFinder())->find()) {
            throw new RuntimeException('Cannot find "php" binary file.');
        }

        return $path;
    }

    /**
     * @return string
     */
    public static function getArtisan(): string
    {
        return defined('ARTISAN_BINARY') ? ARTISAN_BINARY : 'artisan';
    }

    /**
     * @param string $command
     *
     * @throws RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public static function runCommandInBackground(string $command)
    {
        $php = self::getPhpPath();
        $artisan = self::getArtisan();
        $command = self::getBackgroundCommand("{$php} {$artisan} {$command}");

        (new Process($command))->run();
    }

    /**
     * @param string $command
     *
     * @return string
     */
    protected static function getBackgroundCommand(string $command): string
    {
        if (0 === stripos(PHP_OS, 'win')) {
            return "start /B {$command} > NUL";
        }

        return "{$command} > /dev/null 2>&1 &";
    }
}
