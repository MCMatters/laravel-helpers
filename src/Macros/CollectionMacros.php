<?php

declare(strict_types=1);

namespace McMatters\Helpers\Macros;

use Closure;
use Illuminate\Support\Collection;
use McMatters\Helpers\Helpers\ArrayHelper;

class CollectionMacros extends AbstractMacroable
{
    protected function registerFilterMap(): void
    {
        Collection::macro('filterMap', function (Closure $condition, Closure $map): Collection {
            $data = [];

            foreach ($this->all() as $item) {
                if ($condition($item)) {
                    $data[] = $map($item);
                }
            }

            return new Collection($data);
        });
    }

    protected function registerFirstKey(): void
    {
        Collection::macro('firstKey', function (): int|string|null {
            return ArrayHelper::firstKey($this->all());
        });
    }
}
