<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use InvalidArgumentException;
use McMatters\Helpers\Helpers\ClassHelper;
use McMatters\Helpers\Tests\Mocks\Tester;

class ClassTest extends TestCase
{
    public function testGetClassConstants()
    {
        $class = new Tester();
        $expected = [
            'STATUS_DISABLED' => 0,
            'STATUS_ENABLED'  => 1,
            'TYPE_PERSONAL'   => 1,
            'TYPE_COMPANY'    => 2,
        ];

        $this->assertEquals($expected, ClassHelper::getConstants($class));
        $this->assertEquals($expected, ClassHelper::getConstants(get_class($class)));
    }

    public function testGetClassConstantsWithException()
    {
        $this->expectException(InvalidArgumentException::class);
        ClassHelper::getConstants(null);
    }

    public function testGetClassConstantsStartWith()
    {
        $class = new Tester();
        $constants = ClassHelper::getConstantsStartWith($class, 'TYPE_');
        $expected = [
            'TYPE_PERSONAL' => 1,
            'TYPE_COMPANY'  => 2,
        ];

        $this->assertEquals($expected, $constants);
    }
}
