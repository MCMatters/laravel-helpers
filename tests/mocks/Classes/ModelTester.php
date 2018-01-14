<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelTester
 *
 * @package McMatters\Helpers\Tests\Mocks
 */
class ModelTester extends Model
{
    /**
     * @var string
     */
    protected $table = 'foo_bar';
}
