<?php

declare(strict_types = 1);

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
     * @throws \PHPUnit\Framework\AssertionFailedError
     * @throws \RuntimeException
     */
    public function testGetPhpPath()
    {
        $this->assertNotEmpty(ArtisanHelper::getPhpPath());
    }

    /**
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testGetArtisan()
    {
        $this->assertStringEndsWith("artisan'", ArtisanHelper::getArtisan());
    }
}
