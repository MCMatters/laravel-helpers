<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * Class ArrayTest
 */
class ArrayTest extends TestCase
{
    /**
     * Test function "array_key_by".
     */
    public function testArrayKeyBy()
    {
        $array = require __DIR__.'/mocks/arrays/keyBy.php';

        $newArray = array_key_by($array, 'id');

        $this->assertEquals([3, 5, 7], array_keys($newArray));
        $this->assertNotEquals([3, 7, 5], array_keys($newArray));
    }

    /**
     * Test function "array_get_random".
     */
    public function testArrayGetRandom()
    {
        $array = require __DIR__.'/mocks/arrays/getRandom.php';

        for ($i = 0; $i <= 100; $i++) {
            $this->assertTrue(in_array(array_get_random($array), $array, true));
        }
    }

    /**
     * Test function "array_contains".
     */
    public function testArrayContains()
    {
        $array = require __DIR__.'/mocks/arrays/contains.php';

        $this->assertTrue(array_contains($array, 'foo'));
        $this->assertTrue(array_contains($array, 'bar'));
        $this->assertTrue(array_contains($array, 'some'));
        $this->assertTrue(array_contains($array, 'magic'));
        $this->assertTrue(array_contains($array, 'Some magic'));
        $this->assertTrue(array_contains($array, ' magic '));
        $this->assertTrue(array_contains($array, 'test', true));
        $this->assertTrue(array_contains($array, 'baz', true));

        $this->assertFalse(array_contains($array, 'test'));
        $this->assertFalse(array_contains($array, 'nested'));
        $this->assertFalse(array_contains($array, 'array'));
        $this->assertFalse(array_contains($array, 'magic,'));
    }
}
