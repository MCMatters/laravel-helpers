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
        $constants = get_class_constants($class);
        $expected = [
            'STATUS_DISABLED' => 0,
            'STATUS_ENABLED'  => 1,
            'TYPE_PERSONAL'   => 1,
            'TYPE_COMPANY'    => 2,
        ];

        $this->assertEquals($expected, $constants);
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
