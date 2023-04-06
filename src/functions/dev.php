<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\DevHelper;

if (!function_exists('ddq')) {
    function ddq(object $query, bool $die = false): string
    {
        return DevHelper::ddq($query, $die);
    }
}

if (!function_exists('dump')) {
    function dump(mixed $value, bool $output = false): void
    {
        DevHelper::dump($value, $output);
    }
}
