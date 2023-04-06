<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Str;
use McMatters\Helpers\Helpers\TypeHelper;

use function json_encode;

use const false;
use const null;
use const true;

class TypeTest extends TestCase
{
    public function testRandomBool(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $bool = TypeHelper::randomBool();
            $this->assertIsBool($bool);
        }
    }

    public function testCastingBool(): void
    {
        $this->assertFalse(TypeHelper::castingBool('f'));
        $this->assertFalse(TypeHelper::castingBool('false'));
        $this->assertFalse(TypeHelper::castingBool('0'));
        $this->assertFalse(TypeHelper::castingBool(0));
        $this->assertFalse(TypeHelper::castingBool(null));
        $this->assertFalse(TypeHelper::castingBool(''));
        $this->assertFalse(TypeHelper::castingBool(false));

        $this->assertTrue(TypeHelper::castingBool('t'));
        $this->assertTrue(TypeHelper::castingBool('true'));
        $this->assertTrue(TypeHelper::castingBool('1'));
        $this->assertTrue(TypeHelper::castingBool(1));
        $this->assertTrue(TypeHelper::castingBool(true));
    }

    public function testIsJson(): void
    {
        $array = ['test'];
        $encoded = json_encode($array);

        $this->assertTrue(TypeHelper::isJson($encoded));
        $this->assertFalse(TypeHelper::isJson(false));
        $this->assertFalse(TypeHelper::isJson(''));
        $this->assertFalse(TypeHelper::isJson([]));
        $this->assertEquals($array, TypeHelper::isJson($encoded, true));
    }
}
