<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * Class GenericTest
 */
class GenericTest extends TestCase
{
    /**
     * Test function "random_bool".
     */
    public function testRandomBool()
    {
        $bool = random_bool();

        $this->assertTrue(is_bool($bool));
    }

    /**
     * Test function "casting_bool".
     */
    public function testCastingBool()
    {
        $this->assertFalse(casting_bool('f'));
        $this->assertFalse(casting_bool('false'));
        $this->assertFalse(casting_bool('0'));
        $this->assertFalse(casting_bool(0));
        $this->assertFalse(casting_bool(null));
        $this->assertFalse(casting_bool(''));
        $this->assertFalse(casting_bool(false));

        $this->assertTrue(casting_bool('t'));
        $this->assertTrue(casting_bool('true'));
        $this->assertTrue(casting_bool('1'));
        $this->assertTrue(casting_bool(1));
        $this->assertTrue(casting_bool(true));
    }
}
