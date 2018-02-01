<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Str;
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
    public function testStrUcwords()
    {
        $this->assertEquals('Foo Bar', Str::ucwords('foo-bar'));
        $this->assertEquals('Foo Bar', Str::ucwords('foo_bar'));
        $this->assertEquals('FOO BAR', Str::ucwords('fOO_bAR'));
        $this->assertEquals('FoO BaR', Str::ucwords('foO_baR'));
    }

    /**
     * @return void
     * @throws \PHPUnit\Framework\Exception
     */
    public function testOccurrences()
    {
        $this->assertCount(2, Str::occurrences('foo', 'o'));
        $this->assertCount(2, Str::occurrences('foo', 'o', true));
        $this->assertCount(0, Str::occurrences('foo', 'O', true));
        $this->assertCount(0, Str::occurrences('bar', 'o'));
        $this->assertCount(0, Str::occurrences('bar', 'o', true));
        $this->assertCount(2, Str::occurrences('foobarbaz', 'b'));
        $this->assertCount(2, Str::occurrences('foobarbaz', 'b', true));
        $this->assertCount(0, Str::occurrences('foobarbaz', 'B', true));
    }
}
