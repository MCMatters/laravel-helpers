<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\ModelHelper;
use McMatters\Helpers\Tests\Mocks\ModelTester;

use function get_class;

/**
 * Class ModelTest
 *
 * @package McMatters\Helpers\Tests
 */
class ModelTest extends TestCase
{
    /**
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function testGetModelFromQuery()
    {
        $this->assertSame(
            ModelTester::class,
            get_class(
                ModelHelper::getModelFromQuery(ModelTester::query())
            )
        );
    }
}
