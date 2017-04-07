<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{
    /**
     * Test function "get_base_url".
     */
    public function testGetBaseUrl()
    {
        $this->assertEquals('', get_base_url('http:/'));
        $this->assertEquals(
            'http://www.example.com',
            get_base_url('http://www.example.com')
        );
        $this->assertEquals(
            'https://www.example.com',
            get_base_url('https://www.example.com')
        );
        $this->assertEquals(
            'http://example.com',
            get_base_url('http://example.com/foo/bar')
        );
        $this->assertNotEquals(
            'https://example.com',
            get_base_url('https://www.example.com')
        );
    }
}
