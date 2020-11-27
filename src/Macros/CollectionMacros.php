<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class CollectionMacros
 *
 * @package McMatters\Helpers\Macros
 */
class CollectionMacros extends AbstractMacroable
{
    /**
     * @return void
     */
    protected function registerFilterMap()
    {
        Collection::macro('filterMap', function (Closure $condition, Closure $map) {
            $data = [];

            foreach ($this->all() as $item) {
                if ($condition($item)) {
                    $data[] = $map($item);
                }
            }

            return new Collection($data);
        });
    }

    /**
     * @return void
     */
    protected function registerFirstKey()
    {
        Collection::macro('firstKey', function () {
            return Arr::firstKey($this->all());
        });
    }
}
