<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ClassHelper;
use McMatters\Helpers\Tests\Mocks\ClassTester;

use const true;

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
     * @throws \ReflectionException
     */
    public function testGetClassConstants(): void
    {
        $class = new ClassTester();
        $expected = [
            'STATUS_DISABLED' => 0,
            'STATUS_ENABLED' => 1,
            'TYPE_PERSONAL' => 1,
            'TYPE_COMPANY' => 2,
        ];

        $this->assertEquals($expected, ClassHelper::getConstants($class));
        $this->assertEquals(
            $expected,
            ClassHelper::getConstants($class::class),
        );
    }

    /**
     * @return void
     *
     * @throws \ReflectionException
     */
    public function testGetClassConstantsStartWith(): void
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
