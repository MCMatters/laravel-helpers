<?php

declare(strict_types = 1);

use Illuminate\Database\Eloquent\Model;
use McMatters\Helpers\Helpers\ModelHelper;

if (!function_exists('get_model_from_query')) {
    /**
     * @param mixed $query
     *
     * @return Model
     * @throws InvalidArgumentException
     */
    function get_model_from_query($query): Model
    {
        return ModelHelper::getModelFromQuery($query);
    }
}

if (!function_exists('destroy_models_from_query')) {
    /**
     * @param mixed $query
     *
     * @return int
     * @throws Exception
     * @throws InvalidArgumentException
     */
    function destroy_models_from_query($query): int
    {
        return ModelHelper::destroyFromQuery($query);
    }
}

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
        return ModelHelper::isMorphedBelongsParent(
            $morphed,
            $parent,
            $name,
            $type,
            $id
        );
    }
}
