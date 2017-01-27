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

if (!function_exists('float_has_remainder')) {
    /**
     * @param float $number
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
     * @return float|int
     */
    function convert_bytes($value, $returnType = 'b')
    {
        $str = new \Illuminate\Support\Str();
        $sizeTypes = get_size_types();
        $stringValue = (string) $value;
        $value = (int) $value;
        $type = trim(
            $str::lower(
                $str::substr($stringValue, $str::length($value))
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
            return $value / pow(1024, $returnTypeKey - $typeKey);
        } else {
            return $value * pow(1024, $typeKey - $returnTypeKey);
        }
    }
}
