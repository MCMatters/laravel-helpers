<?php

declare(strict_types = 1);

use McMatters\Helpers\Helpers\MathHelper;

if (!function_exists('calculate_percentage')) {
    /**
     * @param mixed $count
     * @param mixed $total
     * @param int $decimals
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    function calculate_percentage($count, $total, int $decimals = 1): float
    {
        return MathHelper::getPercentage($count, $total, $decimals);
    }
}

if (!function_exists('calculate_discount')) {
    /**
     * @param mixed $discount
     * @param mixed $total
     * @param int $decimals
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    function calculate_discount($discount, $total, int $decimals = 1): float
    {
        return MathHelper::getDiscount($discount, $total, $decimals);
    }
}

if (!function_exists('calculate_with_discount')) {
    /**
     * @param mixed $discount
     * @param mixed $total
     * @param int $decimals
     *
     * @return float
     *
     * @throws \InvalidArgumentException
     */
    function calculate_with_discount($discount, $total, int $decimals = 1): float
    {
        return MathHelper::getWithDiscount($discount, $total, $decimals);
    }
}

if (!function_exists('has_float_remainder')) {
    /**
     * @param float $number
     *
     * @return bool
     */
    function has_float_remainder(float $number): bool
    {
        return MathHelper::hasFloatRemainder($number);
    }
}

if (!function_exists('get_size_types')) {
    /**
     * @return array
     */
    function get_size_types(): array
    {
        return MathHelper::getSizeTypes();
    }
}

if (!function_exists('convert_bytes')) {
    /**
     * @param int|float|string $value
     * @param string $getType
     *
     * @return float|int
     */
    function convert_bytes($value, string $getType = 'b')
    {
        return MathHelper::convertBytes($value, $getType);
    }
}

if (!function_exists('is_number_even')) {
    /**
     * @param mixed $number
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    function is_number_even($number): bool
    {
        return MathHelper::isNumberEven($number);
    }
}

if (!function_exists('is_number_odd')) {
    /**
     * @param mixed $number
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    function is_number_odd($number): bool
    {
        return MathHelper::isNumberOdd($number);
    }
}

if (!function_exists('is_number_in_range')) {
    /**
     * @param int|float $number
     * @param int|float $from
     * @param int|float $to
     *
     * @return bool
     *
     * @throws \InvalidArgumentException
     */
    function is_number_in_range($number, $from, $to): bool
    {
        return MathHelper::inRange($number, $from, $to);
    }
}
