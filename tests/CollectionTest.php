<?php

declare(strict_types=1);

namespace McMatters\Helpers\Tests;

use Illuminate\Support\Collection;
use McMatters\Helpers\Helpers\MathHelper;

/**
 * Class CollectionTest
 *
 * @package McMatters\Helpers\Tests
 */
class CollectionTest extends TestCase
{
    /**
     * @return void
     */
    public function testFilterMap(): void
    {
        $data = require __DIR__.'/mocks/arrays/filterMap.php';

        $collection = (new Collection($data))->filterMap(
            static function (array $item) {
                return MathHelper::isNumberOdd($item['id']);
            },
            static function (array $item) {
                return $item['title'];
            }
        );

        $this->assertCount(2, $collection);
        $this->assertSame(['Foo', 'Baz'], $collection->all());
    }
}
