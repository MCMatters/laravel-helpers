<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\StringHelper;

use const true;

/**
 * Class StringTest
 *
 * @package McMatters\Helpers\Tests
 */
class StringTest extends TestCase
{
    /**
     * @return void
     */
    public function testStrUcwords(): void
    {
        $this->assertEquals('Foo Bar', StringHelper::ucwords('foo-bar'));
        $this->assertEquals('Foo Bar', StringHelper::ucwords('foo_bar'));
        $this->assertEquals('FOO BAR', StringHelper::ucwords('fOO_bAR'));
        $this->assertEquals('FoO BaR', StringHelper::ucwords('foO_baR'));
    }

    /**
     * @return void
     */
    public function testOccurrences(): void
    {
        $this->assertCount(2, StringHelper::occurrences('foo', 'o'));
        $this->assertCount(2, StringHelper::occurrences('foo', 'o', true));
        $this->assertCount(0, StringHelper::occurrences('foo', 'O', true));
        $this->assertCount(0, StringHelper::occurrences('bar', 'o'));
        $this->assertCount(0, StringHelper::occurrences('bar', 'o', true));
        $this->assertCount(2, StringHelper::occurrences('foobarbaz', 'b'));
        $this->assertCount(2, StringHelper::occurrences('foobarbaz', 'b', true));
        $this->assertCount(0, StringHelper::occurrences('foobarbaz', 'B', true));
    }
}
