<?php

declare(strict_types=1);

use McMatters\Helpers\Helpers\MathHelper;

if (!function_exists('calculate_percentage')) {
    function calculate_percentage(
        float|int $count,
        float|int $total,
        int $decimals = 1,
    ): float {
        return MathHelper::getPercentage($count, $total, $decimals);
    }
}

if (!function_exists('calculate_discount')) {
    function calculate_discount(
        float|int $discount,
        float|int $total,
        int $decimals = 1,
    ): float {
        return MathHelper::getDiscount($discount, $total, $decimals);
    }
}

if (!function_exists('calculate_with_discount')) {
    function calculate_with_discount(
        float|int $discount,
        float|int $total,
        int $decimals = 1,
    ): float {
        return MathHelper::getWithDiscount($discount, $total, $decimals);
    }
}

if (!function_exists('has_float_remainder')) {
    function has_float_remainder(float $number): bool
    {
        return MathHelper::hasFloatRemainder($number);
    }
}

if (!function_exists('get_size_types')) {
    function get_size_types(): array
    {
        return MathHelper::getSizeTypes();
    }
}

if (!function_exists('convert_bytes')) {
    function convert_bytes(
        float|int|string $value,
        string $getType = 'b',
    ): float|int {
        return MathHelper::convertBytes($value, $getType);
    }
}

if (!function_exists('is_number_even')) {
    function is_number_even(float|int $number): bool
    {
        return MathHelper::isNumberEven($number);
    }
}

if (!function_exists('is_number_odd')) {
    function is_number_odd(float|int $number): bool
    {
        return MathHelper::isNumberOdd($number);
    }
}

if (!function_exists('is_number_in_range')) {
    function is_number_in_range(
        float|int $number,
        float|int $from,
        float|int $to,
    ): bool {
        return MathHelper::inRange($number, $from, $to);
    }
}
