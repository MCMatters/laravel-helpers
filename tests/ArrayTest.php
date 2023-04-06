<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ArrayHelper;

use function array_keys;
use function is_array;

use const true;

class ArrayTest extends TestCase
{
    public function testArrayKeyBy(): void
    {
        $array = require __DIR__.'/mocks/arrays/keyBy.php';

        $newArray = ArrayHelper::keyBy($array, 'id');

        $this->assertEquals([3, 5, 7], array_keys($newArray));
        $this->assertNotEquals([3, 7, 5], array_keys($newArray));
    }

    public function testArrayContains(): void
    {
        $array = require __DIR__.'/mocks/arrays/contains.php';

        $this->assertTrue(ArrayHelper::contains($array, 'foo'));
        $this->assertTrue(ArrayHelper::contains($array, 'bar'));
        $this->assertTrue(ArrayHelper::contains($array, 'some'));
        $this->assertTrue(ArrayHelper::contains($array, 'magic'));
        $this->assertTrue(ArrayHelper::contains($array, 'Some magic'));
        $this->assertTrue(ArrayHelper::contains($array, ' magic '));
        $this->assertTrue(ArrayHelper::contains($array, 'test', true));
        $this->assertTrue(ArrayHelper::contains($array, 'baz', true));

        $this->assertFalse(ArrayHelper::contains($array, 'test'));
        $this->assertFalse(ArrayHelper::contains($array, 'nested'));
        $this->assertFalse(ArrayHelper::contains($array, 'array'));
        $this->assertFalse(ArrayHelper::contains($array, 'magic,'));
    }

    public function testArrayHasIntKeys(): void
    {
        $array = require __DIR__.'/mocks/arrays/hasIntKeys.php';

        $this->assertTrue(ArrayHelper::hasOnlyIntKeys($array['int']));
        $this->assertTrue(ArrayHelper::hasOnlyIntKeys($array['int2']));

        $this->assertFalse(ArrayHelper::hasOnlyIntKeys($array['float']));
        $this->assertFalse(ArrayHelper::hasOnlyIntKeys($array['string']));
    }

    public function testArrayChangeKeyCaseRecursive(): void
    {
        $array = require __DIR__.'/mocks/arrays/changeKeyCase.php';

        $lowerCased = ArrayHelper::changeKeyCaseRecursive($array, CASE_LOWER);
        $upperCased = ArrayHelper::changeKeyCaseRecursive($array, CASE_UPPER);

        $this->checkArrayKeysCase($lowerCased, 'strtolower');
        $this->checkArrayKeysCase($upperCased, 'strtoupper');
    }

    public function testArrayHasValue(): void
    {
        $array = require __DIR__.'/mocks/arrays/hasValue.php';

        $this->assertTrue(ArrayHelper::hasValue('foo', $array));
        $this->assertTrue(ArrayHelper::hasValue('bar', $array));
        $this->assertTrue(ArrayHelper::hasValue('Foo', $array));
        $this->assertTrue(ArrayHelper::hasValue('FOO', $array));
        $this->assertTrue(ArrayHelper::hasValue('BAZ', $array));
        $this->assertFalse(ArrayHelper::hasValue('BaZ', $array));
        $this->assertTrue(ArrayHelper::hasValue('baz', $array, true, true));
        $this->assertTrue(ArrayHelper::hasValue('bAz', $array, true, true));
        $this->assertTrue(ArrayHelper::hasValue('qWe', $array, true, true));
    }

    protected function checkArrayKeysCase(array $array, string $method): void
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->checkArrayKeysCase($value, $method);
            }

            $this->assertSame($method($key), $key);
        }
    }
}
