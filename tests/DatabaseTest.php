<?php

declare(strict_types = 1);

use McMatters\Helpers\Tests\DatabaseTester;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * Test function "compile_sql_query".
     */
    public function testCompileSqlQuery()
    {
        $mocks = require __DIR__.'/mocks/arrays/compileSql.php';

        foreach ($mocks as $mock) {
            $this->assertEquals($mock[2], compile_sql_query($mock[0], $mock[1]));
            $class = new DatabaseTester($mock[0], $mock[1]);
            $this->assertEquals($mock[2], compile_sql_query($class));
        }
    }
}
