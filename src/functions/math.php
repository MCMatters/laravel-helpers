<?php

declare(strict_types = 1);

use Illuminate\Support\Str;

if (!function_exists('calculate_percentage')) {
    /**
     * @param int|float $count
     * @param int|float $total
     * @param int $decimals
     * @return float
     */
    function calculate_percentage($count, $total, int $decimals = 1): float
    {
        if (!is_numeric($count) || !is_numeric($total)) {
            throw new InvalidArgumentException('$count or $total must be numeric');
        }

        $count *= 100;

        return $count > 0
            ? (float) number_format($count / $total, $decimals, '.', '')
            : 0.0;
    }
}

if (!function_exists('calculate_discount')) {
    /**
     * @param int|float $discount
     * @param int|float $total
     * @param int $decimals
     *
     * @return float
     */
    function calculate_discount($discount, $total, int $decimals = 1): float
    {
        $number = ($total / 100) * $discount;

        return (float) number_format($number, $decimals, '.', '');
    }
}

if (!function_exists('calculate_with_discount')) {
    /**
     * @param int|float $discount
     * @param int|float $total
     * @param int $decimals
     *
     * @return float
     */
    function calculate_with_discount($discount, $total, int $decimals = 1): float
    {
        $number = $total - calculate_discount($discount, $total, $decimals);

        return (float) number_format($number, $decimals, '.', '');
    }
}

if (!function_exists('float_has_remainder')) {
    /**
     * @param float $number
     *
     * @return bool
     */
    function float_has_remainder(float $number): bool
    {
        return $number != (int) $number;
    }
}

if (!function_exists('convert_bytes')) {
    /**
     * @param $value
     * @param string $returnType
     *
     * @return float|int
     */
    function convert_bytes($value, string $returnType = 'b')
    {
        $sizeTypes = get_size_types();
        $stringValue = (string) $value;
        $value = (int) $value;
        $type = trim(
            Str::lower(
                Str::substr($stringValue, Str::length($value))
            )
        );

        if (!$type) {
            $type = 'b';
        }

        $type = $type === 'b' ? $type : $type.'b';

        if ($type === $returnType || !in_array($returnType, $sizeTypes, true)) {
            return $value;
        }

        $returnTypeKey = array_search($returnType, $sizeTypes, true);
        $typeKey = array_search($type, $sizeTypes, true);

        if ($returnTypeKey > $typeKey) {
            return $value / (1024 ** ($returnTypeKey - $typeKey));
        }

        return $value * (1024 ** ($typeKey - $returnTypeKey));
    }
}
