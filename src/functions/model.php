<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use McMatters\Helpers\Helpers\ModelHelper;

if (!function_exists('get_model_from_query')) {
    function get_model_from_query(object $query): Model
    {
        return ModelHelper::getModelFromQuery($query);
    }
}

if (!function_exists('destroy_models_from_query')) {
    /**
     * @throws \InvalidArgumentException
     */
    function destroy_models_from_query(object $query): int
    {
        return ModelHelper::destroyFromQuery($query);
    }
}

if (!function_exists('does_model_belong_to')) {
    function does_model_belong_to(
        Model $child,
        Model $parent,
        ?string $foreignKey = null,
        ?string $ownerKey = null,
    ): bool {
        return ModelHelper::doesBelongTo($child, $parent, $foreignKey, $ownerKey);
    }
}

if (!function_exists('does_morphed_model_belong_to_parent')) {
    function does_morphed_model_belong_to_parent(
        Model $morphed,
        Model $parent,
        string $name,
        ?string $type = null,
        ?string $id = null,
    ): bool {
        return ModelHelper::doesMorphedBelongToParent(
            $morphed,
            $parent,
            $name,
            $type,
            $id,
        );
    }
}
