<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

/**
 * Class RequestTest
 *
 * @package McMatters\Helpers\Tests
 */
class RequestTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \PHPUnit\Framework\AssertionFailedError
     */
    public function testIsUpdateMethod()
    {
        $request = RequestFacade::instance();

        $this->assertFalse(Request::isUpdateMethod());

        $request->setMethod('patch');
        $this->assertTrue(Request::isUpdateMethod());

        $request->setMethod('put');
        $this->assertTrue(Request::isUpdateMethod());

        $request->setMethod('get');
        $this->assertFalse(Request::isUpdateMethod());
    }
}
