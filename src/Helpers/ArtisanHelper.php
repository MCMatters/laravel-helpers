<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Support\ProcessUtils;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

use function implode;
use function is_array;
use function is_numeric;
use function preg_match;

use const false;
use const true;

class ArtisanHelper
{
    public static function getPhpPath(): string
    {
        return Application::phpBinary();
    }

    public static function getArtisan(): string
    {
        $artisan = Application::artisanBinary();

        if ('artisan' === $artisan) {
            $fullPath = (new ExecutableFinder())->find(
                'artisan',
                'artisan',
                [Container::getInstance()->basePath()],
            );

            $artisan = $fullPath
                ? ProcessUtils::escapeArgument($fullPath)
                : $artisan;
        }

        return $artisan;
    }

    public static function runCommandInBackground(
        string $command,
        array $parameters = [],
    ): void {
        $command = self::getCompiledCommand($command, $parameters, true);

        Process::fromShellCommandline($command)->start();
    }

    public static function runRawCommand(string $command): void
    {
        Process::fromShellCommandline($command)->start();
    }

    public static function getCompiledCommand(
        string $command,
        array $parameters = [],
        bool $background = false,
    ): string {
        $php = self::getPhpPath();
        $artisan = self::getArtisan();
        $args = self::compileParameters($parameters);

        $command = "{$php} {$artisan} {$command} {$args}";

        return $background
            ? self::getBackgroundCommand($command)
            : self::getForegroundCommand($command);
    }

    public static function getCompiledCommands(
        array $commands,
        bool $background = false,
    ): string {
        $compiled = [];

        foreach ($commands as $commandData) {
            $compiled[] = self::getCompiledCommand(
                $commandData['command'],
                $commandData['parameters'] ?? [],
            );
        }

        return $background
            ? '('.implode(' ; ', $compiled).') &'
            : implode(' && ', $compiled);
    }

    protected static function getBackgroundCommand(string $command): string
    {
        if (ServerHelper::isWindowsOs()) {
            return "start /B {$command} > NUL";
        }

        return "{$command} > /dev/null 2>&1 &";
    }

    protected static function getForegroundCommand(string $command): string
    {
        if (ServerHelper::isWindowsOs()) {
            return "start {$command} > NUL";
        }

        return "{$command} > /dev/null 2>&1";
    }

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
