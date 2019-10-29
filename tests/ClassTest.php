<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use InvalidArgumentException;
use McMatters\Helpers\Helpers\ClassHelper;
use McMatters\Helpers\Tests\Mocks\ClassTester;

use function get_class;

use const null, true;

/**
 * Class ClassTest
 *
 * @package McMatters\Helpers\Tests
 */
class ClassTest extends TestCase
{
    /**
     * @return void
     *
     * @throws InvalidArgumentException
     * @throws \ReflectionException
     */
    public function testGetClassConstants()
    {
        $class = new ClassTester();
        $expected = [
            'STATUS_DISABLED' => 0,
            'STATUS_ENABLED' => 1,
            'TYPE_PERSONAL' => 1,
            'TYPE_COMPANY' => 2,
        ];

        $this->assertEquals($expected, ClassHelper::getConstants($class));
        $this->assertEquals($expected, ClassHelper::getConstants(get_class($class)));
    }

    /**
     * @return void
     * @throws InvalidArgumentException
     * @throws \PHPUnit\Framework\Exception
     * @throws \ReflectionException
     */
    public function testGetClassConstantsWithException()
    {
        $this->expectException(InvalidArgumentException::class);
        ClassHelper::getConstants(null);
    }

    /**
     * @return void
     *
     * @throws \InvalidArgumentException
     * @throws \ReflectionException
     */
    public function testGetClassConstantsStartWith()
    {
        $class = new ClassTester();
        $constants = ClassHelper::getConstantsStartWith($class, 'TYPE_');
        $expected = [
            'TYPE_PERSONAL' => 1,
            'TYPE_COMPANY' => 2,
        ];

        $this->assertEquals($expected, $constants);

        $constants = ClassHelper::getConstantsStartWith($class, 'TYPE_', true);
        $expected = [
            'PERSONAL' => 1,
            'COMPANY' => 2,
        ];

        $this->assertEquals($expected, $constants);
    }
}
