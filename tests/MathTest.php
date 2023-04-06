<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\MathHelper;

class MathTest extends TestCase
{
    public function testCalculatePercentage(): void
    {
        $this->assertEquals(50.0, MathHelper::getPercentage(50, 100));
        $this->assertEquals(23.8095, MathHelper::getPercentage(5, 21, 4));
    }

    public function testCalculateDiscount(): void
    {
        $this->assertEquals(25, MathHelper::getDiscount(25, 100));
        $this->assertEquals(33, MathHelper::getDiscount(33, 100));
    }

    public function testFloatHasRemainder(): void
    {
        $this->assertTrue(MathHelper::hasFloatRemainder(23.6));
        $this->assertFalse(MathHelper::hasFloatRemainder(23.0));
        $this->assertFalse(MathHelper::hasFloatRemainder(12));
    }

    public function testConvertBytes(): void
    {
        $this->assertEquals(1024, MathHelper::convertBytes('1T', 'gb'));
        $this->assertEquals(1048576, MathHelper::convertBytes('1T', 'mb'));
        $this->assertEquals(1073741824, MathHelper::convertBytes('1T', 'kb'));
        $this->assertEquals(1099511627776, MathHelper::convertBytes('1T', 'b'));
        $this->assertEquals(1, MathHelper::convertBytes('1024G', 'tb'));
        $this->assertEquals(1, MathHelper::convertBytes('1048576M', 'tb'));
        $this->assertEquals(1, MathHelper::convertBytes('1073741824K', 'tb'));
        $this->assertEquals(1, MathHelper::convertBytes('1099511627776B', 'tb'));

        $this->assertEquals(1024, MathHelper::convertBytes('1G', 'mb'));
        $this->assertEquals(1048576, MathHelper::convertBytes('1G', 'kb'));
        $this->assertEquals(1073741824, MathHelper::convertBytes('1G', 'b'));
        $this->assertEquals(1, MathHelper::convertBytes('1024M', 'gb'));
        $this->assertEquals(1, MathHelper::convertBytes('1048576K', 'gb'));
        $this->assertEquals(1, MathHelper::convertBytes('1073741824B', 'gb'));

        $this->assertEquals(1024, MathHelper::convertBytes('1M', 'kb'));
        $this->assertEquals(1048576, MathHelper::convertBytes('1M', 'b'));
        $this->assertEquals(1, MathHelper::convertBytes('1024K', 'mb'));
        $this->assertEquals(1, MathHelper::convertBytes('1048576B', 'mb'));

        $this->assertEquals(1024, MathHelper::convertBytes('1K', 'b'));
    }

    public function testIsNumberEven(): void
    {
        $numbers = require __DIR__.'/mocks/arrays/evenOdd.php';

        foreach ($numbers['even'] as $number) {
            $this->assertTrue(MathHelper::isNumberEven($number));
        }

        foreach ($numbers['odd'] as $number) {
            $this->assertFalse(MathHelper::isNumberEven($number));
        }
    }

    public function testIsNumberOdd(): void
    {
        $numbers = require __DIR__.'/mocks/arrays/evenOdd.php';

        foreach ($numbers['odd'] as $number) {
            $this->assertTrue(MathHelper::isNumberOdd($number));
        }

        foreach ($numbers['even'] as $number) {
            $this->assertFalse(MathHelper::isNumberOdd($number));
        }
    }

    public function testInRange(): void
    {
        $this->assertTrue(MathHelper::inRange(5, 4, 6));
        $this->assertTrue(MathHelper::inRange(5, 3, 6));
        $this->assertTrue(MathHelper::inRange(5.5, 5, 6));

        $this->assertFalse(MathHelper::inRange(2, 5, 6));
    }
}
