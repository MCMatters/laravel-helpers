<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * Class MathTest
 */
class MathTest extends TestCase
{
    /**
     * Test function "calculate_percentage".
     */
    public function testCalculatePercentage()
    {
        $this->assertEquals(50.0, calculate_percentage(50, 100));
        $this->assertEquals(23.8095, calculate_percentage(5, 21, 4));
    }

    /**
     * Test function "calculate_percentage" with exception.
     */
    public function testCalculatePercentageWithException()
    {
        $this->expectException(InvalidArgumentException::class);
        calculate_percentage('SomeNumber', 21, 4);
    }

    /**
     * Test function "calculate_discount".
     */
    public function TestCalculateDiscount()
    {
        $this->assertEquals(25, calculate_discount(25, 100));
        $this->assertEquals(33, calculate_discount(33, 100));
    }

    /**
     * Test function "float_has_remainder".
     */
    public function testFloatHasRemainder()
    {
        $this->assertTrue(float_has_remainder(23.6));
        $this->assertFalse(float_has_remainder(23.0));
        $this->assertFalse(float_has_remainder(12));
    }

    /**
     * Test function "convert_bytes".
     */
    public function testConvertBytes()
    {
        $this->assertEquals(1024, convert_bytes('1T', 'gb'));
        $this->assertEquals(1048576, convert_bytes('1T', 'mb'));
        $this->assertEquals(1073741824, convert_bytes('1T', 'kb'));
        $this->assertEquals(1099511627776, convert_bytes('1T', 'b'));
        $this->assertEquals(1, convert_bytes('1024G', 'tb'));
        $this->assertEquals(1, convert_bytes('1048576M', 'tb'));
        $this->assertEquals(1, convert_bytes('1073741824K', 'tb'));
        $this->assertEquals(1, convert_bytes('1099511627776B', 'tb'));

        $this->assertEquals(1024, convert_bytes('1G', 'mb'));
        $this->assertEquals(1048576, convert_bytes('1G', 'kb'));
        $this->assertEquals(1073741824, convert_bytes('1G', 'b'));
        $this->assertEquals(1, convert_bytes('1024M', 'gb'));
        $this->assertEquals(1, convert_bytes('1048576K', 'gb'));
        $this->assertEquals(1, convert_bytes('1073741824B', 'gb'));

        $this->assertEquals(1024, convert_bytes('1M', 'kb'));
        $this->assertEquals(1048576, convert_bytes('1M', 'b'));
        $this->assertEquals(1, convert_bytes('1024K', 'mb'));
        $this->assertEquals(1, convert_bytes('1048576B', 'mb'));

        $this->assertEquals(1024, convert_bytes('1K', 'b'));
    }
}
