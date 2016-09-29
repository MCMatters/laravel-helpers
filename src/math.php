<?php

declare(strict_types = 1);

if (!function_exists('calculate_percentage')) {
    /**
     * @param int $count
     * @param int $total
     * @param int $decimals
     * @return string
     */
    function calculate_percentage(int $count, int $total, int $decimals = 1): string
    {
        $count *= 100;
        return $count > 0 ? number_format($count / $total, $decimals) : '0';
    }
}
