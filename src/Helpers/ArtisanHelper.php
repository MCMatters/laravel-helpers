<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Support\ProcessUtils;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use function implode, is_array, is_numeric, preg_match, stripos;

/**
 * Class ArtisanHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ArtisanHelper
{
    /**
     * @return string
     */
    public static function getPhpPath(): string
    {
        return Application::phpBinary();
    }

    /**
     * @return string
     */
    public static function getArtisan(): string
    {
        $artisan = Application::artisanBinary();

        if ($artisan === 'artisan') {
            $fullPath = (new ExecutableFinder())->find(
                'artisan',
                'artisan',
                [Container::getInstance()->basePath()]
            );

            $artisan = $fullPath
                ? ProcessUtils::escapeArgument($fullPath)
                : $artisan;
        }

        return $artisan;
    }

    /**
     * @param string $command
     * @param array $parameters
     *
     * @return void
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     * @throws \Symfony\Component\Process\Exception\LogicException
     */
    public static function runCommandInBackground(string $command, array $parameters = [])
    {
        $php = self::getPhpPath();
        $artisan = self::getArtisan();
        $args = self::compileParameters($parameters);
        $command = self::getBackgroundCommand("{$php} {$artisan} {$command} {$args}");

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

    /**
     * @param array $parameters
     *
     * @return string
     */
    protected static function compileParameters(array $parameters): string
    {
        $compiled = [];

        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $values = [];

                foreach ($value as $item) {
                    $values[] = ProcessUtils::escapeArgument($item);
                }

                $value = implode(' ', $values);
            } elseif (!is_numeric($value) && !preg_match('/^(-.$|--.*)/', $value)) {
                $value = ProcessUtils::escapeArgument($value);
            }

            $compiled[] = is_numeric($key) ? $value : "{$key}={$value}";
        }

        return implode(' ', $compiled);
    }
}
