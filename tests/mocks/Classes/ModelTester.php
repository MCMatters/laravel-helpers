<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;

class ModelTester extends Model
{
    protected $table = 'foo_bar';
}
