<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    /**
     * Test function "str_lower".
     */
    public function testStrLower()
    {
        $this->assertEquals('hello world', str_lower('HeLlo WoRLd'));
        $this->assertEquals('foobar', str_lower('fooBAR'));
        $this->assertNotEquals('fooBAZ', str_lower('fooBAZ'));
    }

    /**
     * Test function "str_upper".
     */
    public function testStrUpper()
    {
        $this->assertEquals('HELLO WORLD', str_upper('heLlo WorLD'));
        $this->assertEquals('FOOBAR', str_upper('foOBaR'));
        $this->assertNotEquals('fooBAZ', str_upper('fooBAZ'));
    }

    /**
     * Test function "str_ucwords".
     */
    public function testStrUcwords()
    {
        $this->assertEquals('Foo Bar', str_ucwords('foo-bar'));
        $this->assertEquals('Foo Bar', str_ucwords('foo_bar'));
        $this->assertEquals('FOO BAR', str_ucwords('fOO_bAR'));
        $this->assertEquals('FoO BaR', str_ucwords('foO_baR'));
    }

    /**
     * Test function "strpos_array".
     */
    public function testStrposArray()
    {
        $this->assertEquals(0, strpos_array('foobar', 'foo'));
        $this->assertEquals(0, strpos_array('foobar', ['foo']));
        $this->assertFalse(strpos_array('foobar', 'baz'));
        $this->assertFalse(strpos_array('foobar', ['baz']));
        $this->assertEquals(0, strpos_array('foobar', ['foo', 'bar', 'baz']));
        $this->assertEquals(0, strpos_array('foobar', ['bar', 'foo', 'baz']));
    }
}
