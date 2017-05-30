<?php

declare(strict_types = 1);

use Illuminate\Database\Eloquent\Model;

if (!function_exists('is_morphed_belongs_parent')) {
    /**
     * @param Model $morphed
     * @param Model $parent
     * @param string $name
     * @param string|null $type
     * @param string|null $id
     *
     * @return bool
     */
    function is_morphed_belongs_parent(
        Model $morphed,
        Model $parent,
        string $name,
        string $type = null,
        string $id = null
    ): bool {
        $type = $type ?: "{$name}_type";
        $id = $id ?: "{$name}_id";

        return $morphed->getAttribute($type) === get_class($parent) &&
            $morphed->getAttribute($id) === $parent->getKey();
    }
}
