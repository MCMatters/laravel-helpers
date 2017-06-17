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

    /**
     * Test function "is_json".
     */
    public function testIsJson()
    {
        $array = ['test'];
        $encoded = json_encode($array);

        $this->assertTrue(is_json($encoded));
        $this->assertFalse(is_json(false));
        $this->assertFalse(is_json(''));
        $this->assertFalse(is_json([]));
        $this->assertEquals($array, is_json($encoded, true));
    }

    /**
     * Test "is_uuid".
     */
    public function testIsUuid()
    {
        $valid = '5b6de545-3d60-48f1-ad30-0e6fa786ffb0';
        $notValid = '5g6de545-3d60-48f1-ad30-0e6fa786ffb0';

        $this->assertTrue(is_uuid($valid));
        $this->assertFalse(is_uuid($notValid));
        $this->assertFalse(is_uuid(null));
        $this->assertFalse(is_uuid('null'));
        $this->assertFalse(is_uuid(''));
        $this->assertFalse(is_uuid(base64_encode(random_bytes(16))));
    }
}
