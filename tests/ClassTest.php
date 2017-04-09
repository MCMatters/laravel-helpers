<?php

use PHPUnit\Framework\TestCase;

/**
 * Class ClassTest
 */
class ClassTest extends TestCase
{
    /**
     * Test function "get_class_constants".
     */
    public function testGetClassConstants()
    {
        $class = new \McMatters\Helpers\Tests\Tester();
        $expected = [
            'STATUS_DISABLED' => 0,
            'STATUS_ENABLED'  => 1,
            'TYPE_PERSONAL'   => 1,
            'TYPE_COMPANY'    => 2,
        ];

        $this->assertEquals($expected, get_class_constants($class));
        $this->assertEquals($expected, get_class_constants(get_class($class)));
    }

    /**
     * Test function "get_class_constants" with exception.
     */
    public function testGetClassConstantsWithException()
    {
        get_class_constants(null);
        $this->expectException(InvalidArgumentException::class);
    }

    /**
     * Test function "get_class_constants_start_with".
     */
    public function testGetClassConstantsStartWith()
    {
        $class = new \McMatters\Helpers\Tests\Tester();
        $constants = get_class_constants_start_with($class, 'TYPE_');
        $expected = [
            'TYPE_PERSONAL' => 1,
            'TYPE_COMPANY'  => 2,
        ];

        $this->assertEquals($expected, $constants);
    }
}
