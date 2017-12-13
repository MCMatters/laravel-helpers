<?php

declare(strict_types = 1);

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

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

if (!function_exists('get_model_from_query')) {
    /**
     * @param Relation|Builder $query
     *
     * @return Model
     * @throws InvalidArgumentException
     */
    function get_model_from_query($query): Model
    {
        if ($query instanceof Relation) {
            return $query->getRelated();
        }

        if ($query instanceof Builder) {
            return $query->getModel();
        }

        throw new InvalidArgumentException('Not supported query.');
    }
}

if (!function_exists('destroy_models_from_query')) {
    /**
     * @param mixed $query
     *
     * @return int
     * @throws InvalidArgumentException
     */
    function destroy_models_from_query($query): int
    {
        $count = 0;

        $model = get_model_from_query($query);

        $query->get([$model->getQualifiedKeyName()])->each(
            function (Model $model) use (&$count) {
                $count += (int) $model->delete();
            }
        );

        return $count;
    }
}
