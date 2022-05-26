<?php

declare(strict_types=1);

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
     */
    public function testIsProduction(): void
    {
        $this->assertFalse(EnvHelper::isProduction());
    }

    /**
     * @return void
     */
    public function testIsStaging(): void
    {
        $this->assertFalse(EnvHelper::isStaging());
    }

    /**
     * @return void
     */
    public function testIsLocal(): void
    {
        $this->assertFalse(EnvHelper::isLocal());
    }

    /**
     * @return void
     */
    public function testIsTesting(): void
    {
        $this->assertTrue(EnvHelper::isTesting());
    }
}
