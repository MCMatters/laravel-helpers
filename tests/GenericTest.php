<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\GenericHelper;

class GenericTest extends TestCase
{
    public function testRandomBool()
    {
        for ($i = 0; $i < 100; $i++) {
            $bool = GenericHelper::randomBool();
            $this->assertTrue(is_bool($bool));
        }
    }

    public function testCastingBool()
    {
        $this->assertFalse(GenericHelper::castingBool('f'));
        $this->assertFalse(GenericHelper::castingBool('false'));
        $this->assertFalse(GenericHelper::castingBool('0'));
        $this->assertFalse(GenericHelper::castingBool(0));
        $this->assertFalse(GenericHelper::castingBool(null));
        $this->assertFalse(GenericHelper::castingBool(''));
        $this->assertFalse(GenericHelper::castingBool(false));

        $this->assertTrue(GenericHelper::castingBool('t'));
        $this->assertTrue(GenericHelper::castingBool('true'));
        $this->assertTrue(GenericHelper::castingBool('1'));
        $this->assertTrue(GenericHelper::castingBool(1));
        $this->assertTrue(GenericHelper::castingBool(true));
    }

    public function testIsJson()
    {
        $array = ['test'];
        $encoded = json_encode($array);

        $this->assertTrue(GenericHelper::isJson($encoded));
        $this->assertFalse(GenericHelper::isJson(false));
        $this->assertFalse(GenericHelper::isJson(''));
        $this->assertFalse(GenericHelper::isJson([]));
        $this->assertEquals($array, GenericHelper::isJson($encoded, true));
    }

    public function testIsUuid()
    {
        $valid = '5b6de545-3d60-48f1-ad30-0e6fa786ffb0';
        $notValid = '5g6de545-3d60-48f1-ad30-0e6fa786ffb0';

        $this->assertTrue(GenericHelper::isUuid($valid));
        $this->assertFalse(GenericHelper::isUuid($notValid));
        $this->assertFalse(GenericHelper::isUuid(null));
        $this->assertFalse(GenericHelper::isUuid('null'));
        $this->assertFalse(GenericHelper::isUuid(''));
        $this->assertFalse(GenericHelper::isUuid(base64_encode(random_bytes(16))));
    }
}
