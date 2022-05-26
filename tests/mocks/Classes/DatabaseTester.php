<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests\Mocks;

/**
 * Class DatabaseTester
 *
 * @package McMatters\Helpers\Tests
 */
class DatabaseTester
{
    /**
     * @var string
     */
    protected string $sql;

    /**
     * @var array
     */
    protected array $bindings;

    /**
     * DatabaseTester constructor.
     *
     * @param string $sql
     * @param array $bindings
     */
    public function __construct(string $sql, array $bindings = [])
    {
        $this->sql = $sql;
        $this->bindings = $bindings;
    }

    /**
     * @return string
     */
    public function toSql(): string
    {
        return $this->sql;
    }

    /**
     * @return array
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }
}
