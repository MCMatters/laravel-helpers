<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Facades\Request as RequestFacade;

class RequestTest extends TestCase
{
    /**
     * @return void
     */
    public function testIsUpdateMethod(): void
    {
        $request = RequestFacade::instance();

        $this->assertFalse($request->isUpdateMethod());

        $request->setMethod('patch');
        $this->assertTrue($request->isUpdateMethod());

        $request->setMethod('put');
        $this->assertTrue($request->isUpdateMethod());

        $request->setMethod('get');
        $this->assertFalse($request->isUpdateMethod());

        $this->assertFalse(RequestFacade::isUpdateMethod());

        RequestFacade::setMethod('patch');
        $this->assertTrue(RequestFacade::isUpdateMethod());

        RequestFacade::setMethod('put');
        $this->assertTrue(RequestFacade::isUpdateMethod());

        RequestFacade::setMethod('get');
        $this->assertFalse(RequestFacade::isUpdateMethod());
    }
}
