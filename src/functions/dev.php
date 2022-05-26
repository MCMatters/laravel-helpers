<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\DevHelper;

if (!function_exists('ddq')) {
    /**
     * @param object $query
     * @param bool $die
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     * @throws \ErrorException
     */
    function ddq(object $query, bool $die = false): string
    {
        return DevHelper::ddq($query, $die);
    }
}

if (!function_exists('dump')) {
    /**
     * @param mixed $value
     * @param bool $output
     *
     * @return void
     *
     * @throws \ErrorException
     */
    function dump(mixed $value, bool $output = false): void
    {
        DevHelper::dump($value, $output);
    }
}
