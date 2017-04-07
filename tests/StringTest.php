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
}
