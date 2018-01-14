<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Str;

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
}
