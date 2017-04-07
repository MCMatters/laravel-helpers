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
}
