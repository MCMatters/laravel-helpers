<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ArtisanHelper;

class ArtisanTest extends TestCase
{
    public function testGetPhpPath(): void
    {
        $this->assertNotEmpty(ArtisanHelper::getPhpPath());
    }

    public function testGetArtisan(): void
    {
        $this->assertStringEndsWith("artisan'", ArtisanHelper::getArtisan());
    }
}
