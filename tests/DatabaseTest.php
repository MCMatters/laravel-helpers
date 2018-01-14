<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\DBHelper;
use McMatters\Helpers\Tests\Mocks\DatabaseTester;

/**
 * Class DatabaseTest
 *
 * @package McMatters\Helpers\Tests
 */
class DatabaseTest extends TestCase
{
    /**
     * @return void
     * @throws \InvalidArgumentException
     */
    public function testCompileSqlQuery()
    {
        $mocks = require __DIR__.'/mocks/arrays/compileSql.php';

        foreach ($mocks as $mock) {
            $this->assertEquals($mock[2], DBHelper::compileSqlQuery($mock[0], $mock[1]));
            $class = new DatabaseTester($mock[0], $mock[1]);
            $this->assertEquals($mock[2], DBHelper::compileSqlQuery($class));
        }
    }
}
