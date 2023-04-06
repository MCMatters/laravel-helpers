<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\EnvHelper;

class EnvTest extends TestCase
{
    public function testIsProduction(): void
    {
        $this->assertFalse(EnvHelper::isProduction());
    }

    public function testIsStaging(): void
    {
        $this->assertFalse(EnvHelper::isStaging());
    }

    public function testIsLocal(): void
    {
        $this->assertFalse(EnvHelper::isLocal());
    }

    public function testIsTesting(): void
    {
        $this->assertTrue(EnvHelper::isTesting());
    }
}
