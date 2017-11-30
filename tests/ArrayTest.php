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

    /**
     * Test function "array_has_int_keys".
     */
    public function testArrayHasIntKeys()
    {
        $array = require __DIR__.'/mocks/arrays/hasIntKeys.php';

        $this->assertTrue(array_has_int_keys($array['int']));
        $this->assertTrue(array_has_int_keys($array['int2']));

        $this->assertFalse(array_has_int_keys($array['float']));
        $this->assertFalse(array_has_int_keys($array['string']));
    }

    /**
     * Test function "array_change_key_case_recursive".
     */
    public function testArrayChangeKeyCaseRecursive()
    {
        $array = require __DIR__.'/mocks/arrays/changeKeyCase.php';

        $lowerCased = array_change_key_case_recursive($array, CASE_LOWER);
        $upperCased = array_change_key_case_recursive($array, CASE_UPPER);

        $this->checkArrayKeysCase($lowerCased, 'strtolower');
        $this->checkArrayKeysCase($upperCased, 'strtoupper');
    }

    /**
     * @param array $array
     * @param string $method
     *
     * @return void
     */
    protected function checkArrayKeysCase(array $array, string $method)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->checkArrayKeysCase($value, $method);
            }

            $this->assertSame($method($key), $key);
        }
    }
}
