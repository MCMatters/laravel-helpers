<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Arr;

class ArrayTest extends TestCase
{
    public function testArrayKeyBy()
    {
        $array = require __DIR__.'/mocks/arrays/keyBy.php';

        $newArray = Arr::keyBy($array, 'id');

        $this->assertEquals([3, 5, 7], array_keys($newArray));
        $this->assertNotEquals([3, 7, 5], array_keys($newArray));
    }

    public function testArrayContains()
    {
        $array = require __DIR__.'/mocks/arrays/contains.php';

        $this->assertTrue(Arr::contains($array, 'foo'));
        $this->assertTrue(Arr::contains($array, 'bar'));
        $this->assertTrue(Arr::contains($array, 'some'));
        $this->assertTrue(Arr::contains($array, 'magic'));
        $this->assertTrue(Arr::contains($array, 'Some magic'));
        $this->assertTrue(Arr::contains($array, ' magic '));
        $this->assertTrue(Arr::contains($array, 'test', true));
        $this->assertTrue(Arr::contains($array, 'baz', true));

        $this->assertFalse(Arr::contains($array, 'test'));
        $this->assertFalse(Arr::contains($array, 'nested'));
        $this->assertFalse(Arr::contains($array, 'array'));
        $this->assertFalse(Arr::contains($array, 'magic,'));
    }

    public function testArrayHasIntKeys()
    {
        $array = require __DIR__.'/mocks/arrays/hasIntKeys.php';

        $this->assertTrue(Arr::hasOnlyIntKeys($array['int']));
        $this->assertTrue(Arr::hasOnlyIntKeys($array['int2']));

        $this->assertFalse(Arr::hasOnlyIntKeys($array['float']));
        $this->assertFalse(Arr::hasOnlyIntKeys($array['string']));
    }
}
