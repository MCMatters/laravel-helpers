<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\EnvHelper;

/**
 * Class EnvTest
 *
 * @package McMatters\Helpers\Tests
 */
class EnvTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testIsProduction()
    {
        $this->assertFalse(EnvHelper::isProduction());
    }

    /**
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testIsLocal()
    {
        $this->assertFalse(EnvHelper::isLocal());
    }

    /**
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testIsTesting()
    {
        $this->assertTrue(EnvHelper::isTesting());
    }
}
