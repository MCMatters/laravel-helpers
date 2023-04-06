<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use McMatters\Helpers\Helpers\DbHelper;
use McMatters\Helpers\Tests\Mocks\DatabaseTester;

class DatabaseTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     */
    public function testCompileSqlQuery(): void
    {
        $mocks = require __DIR__.'/mocks/arrays/compileSql.php';

        foreach ($mocks as $mock) {
            $this->assertEquals(
                $mock[2],
                DbHelper::compileSqlQuery($mock[0], $mock[1]),
            );

            $class = new DatabaseTester($mock[0], $mock[1]);
            $this->assertEquals($mock[2], DbHelper::compileSqlQuery($class));
        }
    }
}
