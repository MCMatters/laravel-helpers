<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ModelHelper;
use McMatters\Helpers\Tests\Mocks\ModelTester;

use function get_class;

class ModelTest extends TestCase
{
    public function testGetModelFromQuery(): void
    {
        $this->assertSame(
            ModelTester::class,
            get_class(
                ModelHelper::getModelFromQuery(ModelTester::query()),
            ),
        );
    }
}
