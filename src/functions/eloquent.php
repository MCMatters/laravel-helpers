<?php

declare(strict_types = 1);

if (!function_exists('is_morphed_belongs_parent')) {
    /**
     * @param $morphed
     * @param $parent
     * @param string $name
     * @param string|null $type
     * @param string|null $id
     *
     * @return bool
     */
    function is_morphed_belongs_parent(
        $morphed,
        $parent,
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
