<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Str;
use McMatters\Helpers\Helpers\TypeHelper;

use function json_encode;

use const false;
use const null;
use const true;

/**
 * Class StringTest
 *
 * @package McMatters\Helpers\Tests
 */
class TypeTest extends TestCase
{
    /**
     * @return void
     */
    public function testRandomBool(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $bool = TypeHelper::randomBool();
            $this->assertIsBool($bool);
        }
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function testIsUuid(): void
    {
        $valid = '5b6de545-3d60-48f1-ad30-0e6fa786ffb0';
        $notValid = '5g6de545-3d60-48f1-ad30-0e6fa786ffb0';

        $this->assertTrue(TypeHelper::isUuid($valid));
        $this->assertFalse(TypeHelper::isUuid($notValid));
        $this->assertFalse(TypeHelper::isUuid('null'));
        $this->assertFalse(TypeHelper::isUuid(''));
        $this->assertFalse(TypeHelper::isUuid(Str::random(16)));
    }
}
