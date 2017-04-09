<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

/**
 * Class FormsTest
 */
class FormsTest extends TestCase
{
    /**
     * Test function "transform_form_element_key".
     */
    public function testTransformFormElementKey()
    {
        $this->assertEquals('key.1', transform_form_element_key('key[1]'));
        $this->assertEquals('key', transform_form_element_key('key[]'));
        $this->assertEquals('key_1', transform_form_element_key('key.1'));
    }
}
