<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Str;

use function array_search;
use function in_array;
use function number_format;
use function trim;

use const true;

/**
 * Class MathHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class MathHelper
{
    /**
     * @param float|int $count
     * @param float|int $total
     * @param int $decimals
     *
     * @return float
     */
    public static function getPercentage(
        float|int $count,
        float|int $total,
        int $decimals = 1,
    ): float {
        $count *= 100;

        return $count > 0
            ? (float) number_format($count / $total, $decimals, '.', '')
            : 0.0;
    }

    /**
     * @param float|int $discount
     * @param float|int $total
     * @param int $decimals
     *
     * @return float
     */
    public static function getDiscount(
        float|int $discount,
        float|int $total,
        int $decimals = 1,
    ): float {
        $number = ($total / 100) * $discount;

        return (float) number_format($number, $decimals, '.', '');
    }

    /**
     * @param float|int $discount
     * @param float|int $total
     * @param int $decimals
     *
     * @return float
     */
    public static function getWithDiscount(
        float|int $discount,
        float|int $total,
        int $decimals = 1,
    ): float {
        $number = $total - self::getDiscount($discount, $total, $decimals);

        return (float) number_format($number, $decimals, '.', '');
    }

    /**
     * @param float $number
     *
     * @return bool
     */
    public static function hasFloatRemainder(float $number): bool
    {
        return $number != (int) $number;
    }

    /**
     * @return array
     */
    public static function getSizeTypes(): array
    {
        return ['b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
    }

    /**
     * @param float|int|string $value
     * @param string $getType
     *
     * @return float|int
     */
    public static function convertBytes(
        float|int|string $value,
        string $getType = 'b',
    ): float|int {
        $sizeTypes = self::getSizeTypes();
        $stringValue = (string) $value;
        $value = (int) $value;
        $type = trim(
            Str::lower(Str::substr($stringValue, Str::length($value))),
        );

        if (!$type) {
            $type = 'b';
        }

        $type = $type === 'b' ? $type : "{$type}b";

        if (!in_array($type, $sizeTypes, true)) {
            $type = 'b';
        }

        if ($type === $getType || !in_array($getType, $sizeTypes, true)) {
            return $value;
        }

        $getTypeKey = array_search($getType, $sizeTypes, true);
        $typeKey = array_search($type, $sizeTypes, true);

        if ($getTypeKey > $typeKey) {
            return $value / (1024 ** ($getTypeKey - $typeKey));
        }

        return $value * (1024 ** ($typeKey - $getTypeKey));
    }

    /**
     * @param float|int $number
     *
     * @return bool
     */
    public static function isNumberEven(float|int $number): bool
    {
        return $number % 2 === 0;
    }

    /**
     * @param float|int $number
     *
     * @return bool
     */
    public static function isNumberOdd(float|int $number): bool
    {
        return !self::isNumberEven($number);
    }

    /**
     * @param float|int $number
     * @param float|int $from
     * @param float|int $to
     *
     * @return bool
     */
    public static function inRange(
        float|int $number,
        float|int $from,
        float|int $to,
    ): bool {
        return $from <= $number && $to >= $number;
    }
}
