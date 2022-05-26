<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ArtisanHelper;

/**
 * Class ArtisanTest
 *
 * @package McMatters\Helpers\Tests
 */
class ArtisanTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetPhpPath(): void
    {
        $this->assertNotEmpty(ArtisanHelper::getPhpPath());
    }

    /**
     * @return void
     */
    public function testGetArtisan(): void
    {
        $this->assertStringEndsWith("artisan'", ArtisanHelper::getArtisan());
    }
}
