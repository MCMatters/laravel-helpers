<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\DevHelper;

if (!function_exists('ddq')) {
    /**
     * @param mixed $query
     * @param bool $die
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    function ddq($query, bool $die = false): string
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
     */
    function dump($value, bool $output = false)
    {
        DevHelper::dump($value, $output);
    }
}
