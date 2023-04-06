<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests\Mocks;

class DatabaseTester
{
    protected string $sql;

    protected array $bindings;

    public function __construct(string $sql, array $bindings = [])
    {
        $this->sql = $sql;
        $this->bindings = $bindings;
    }

    public function toSql(): string
    {
        return $this->sql;
    }

    public function getBindings(): array
    {
        return $this->bindings;
    }
}
