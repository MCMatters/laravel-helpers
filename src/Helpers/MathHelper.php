<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Support\Str;
use InvalidArgumentException;
use const true;
use function array_search, in_array, is_numeric, number_format, trim;

/**
 * Class MathHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class MathHelper
{
    /**
     * @param int|float $count
     * @param int|float $total
     * @param int $decimals
     *
     * @return float
     * @throws \InvalidArgumentException
     */
    public static function getPercentage(
        $count,
        $total,
        int $decimals = 1
    ): float {
        self::checkIsNumeric($count, '$count');
        self::checkIsNumeric($total, '$total');

        $count *= 100;

        return $count > 0
            ? (float) number_format($count / $total, $decimals, '.', '')
            : 0.0;
    }

    /**
     * @param int|float $discount
     * @param int|float $total
     * @param int $decimals
     *
     * @return float
     * @throws \InvalidArgumentException
     */
    public static function getDiscount(
        $discount,
        $total,
        int $decimals = 1
    ): float {
        self::checkIsNumeric($discount, '$discount');
        self::checkIsNumeric($total, '$total');

        $number = ($total / 100) * $discount;

        return (float) number_format($number, $decimals, '.', '');
    }

    /**
     * @param int|float $discount
     * @param int|float $total
     * @param int $decimals
     *
     * @return float
     * @throws InvalidArgumentException
     */
    public static function getWithDiscount(
        $discount,
        $total,
        int $decimals = 1
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
     * @param int|float|string $value
     * @param string $getType
     *
     * @return float|int
     */
    public static function convertBytes($value, string $getType = 'b')
    {
        $sizeTypes = self::getSizeTypes();
        $stringValue = (string) $value;
        $value = (int) $value;
        $type = trim(
            Str::lower(Str::substr($stringValue, Str::length($value)))
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
     * @param int|float $number
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function isNumberEven($number): bool
    {
        self::checkIsNumeric($number, '$number');

        return $number % 2 === 0;
    }

    /**
     * @param int|float $number
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function isNumberOdd($number): bool
    {
        return !self::isNumberEven($number);
    }

    /**
     * @param int|float $number
     * @param int|float $from
     * @param int|float $to
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function inRange($number, $from, $to): bool
    {
        if (!is_numeric($number) || !is_numeric($from) || !is_numeric($to)) {
            throw new InvalidArgumentException('Arguments must be numeric');
        }

        return $from <= $number && $to >= $number;
    }

    /**
     * @param int|float $number
     * @param string $name
     *
     * @throws \InvalidArgumentException
     */
    protected static function checkIsNumeric($number, string $name)
    {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException("{$name} must be numeric");
        }
    }
}
