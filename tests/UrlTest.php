<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\UrlHelper;

/**
 * Class UrlTest
 *
 * @package McMatters\Helpers\Tests
 */
class UrlTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetBaseUrl()
    {
        $this->assertEquals('', UrlHelper::getBaseUrl('http:/'));

        $this->assertEquals(
            'http://www.example.com',
            UrlHelper::getBaseUrl('http://www.example.com')
        );

        $this->assertEquals(
            'https://www.example.com',
            UrlHelper::getBaseUrl('https://www.example.com')
        );

        $this->assertEquals(
            'http://example.com',
            UrlHelper::getBaseUrl('http://example.com/foo/bar')
        );

        $this->assertNotEquals(
            'https://example.com',
            UrlHelper::getBaseUrl('https://www.example.com')
        );
    }

    /**
     * @return void
     */
    public function testGetHost()
    {
        $this->assertEquals('example.com', UrlHelper::getHost('http://www.example.com'));
        $this->assertEquals('example.com', UrlHelper::getHost('https://www.example.com'));
        $this->assertEquals('example.com', UrlHelper::getHost('http://example.com'));
        $this->assertEquals('example.com', UrlHelper::getHost('https://example.com'));
    }
}
