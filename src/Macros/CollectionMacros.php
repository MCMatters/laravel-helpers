<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Macros;

use Closure;
use Illuminate\Support\Collection;

/**
 * Class CollectionMacros
 *
 * @package McMatters\Helpers\Macros
 */
class CollectionMacros extends AbstractMacroable
{
    /**
     * @return string
     */
    public static function getClass(): string
    {
        return Collection::class;
    }

    /**
     * @param Collection $collection
     * @param Closure $condition
     * @param Closure $map
     *
     * @return Collection
     */
    public function registerFilterMap(
        Collection $collection,
        Closure $condition,
        Closure $map
    ): Collection {
        $data = [];

        foreach ($collection->all() as $item) {
            if ($condition($item)) {
                $data[] = $map($item);
            }
        }

        return new Collection($data);
    }

    /**
     * @param Collection $collection
     *
     * @return int|string|null
     */
    public function registerFirstKey(Collection $collection)
    {
        foreach ($collection->all() as $key => $value) {
            return $key;
        }

        return null;
    }
}
