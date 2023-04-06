<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use function function_exists;

class HelperFunctionsTest extends TestCase
{
    public function testFunctionsEnabled(): void
    {
        $functions = [
            'array_key_first',
            'get_php_path',
            'get_class_constants',
            'compile_sql_query',
            'ddq',
            'is_production_environment',
            'calculate_percentage',
            'get_model_from_query',
            'is_request_method_update',
            'long_processes',
            'str_ucwords',
            'random_bool',
            'get_base_url',
        ];

        foreach ($functions as $function) {
            $this->assertTrue(
                function_exists($function),
                "Function {$function} is not enabled",
            );
        }
    }
}
