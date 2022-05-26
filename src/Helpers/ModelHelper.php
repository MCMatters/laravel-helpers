<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;

use function is_array;
use function is_string;

use const null;

/**
 * Class ModelHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ModelHelper
{
    /**
     * @param object $query
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \InvalidArgumentException
     */
    public static function getModelFromQuery(object $query): Model
    {
        if ($query instanceof Relation) {
            return $query->getRelated();
        }

        if ($query instanceof Builder) {
            return $query->getModel();
        }

        throw new InvalidArgumentException('Not supported query.');
    }

    /**
     * @param object $query
     * @param array|string|null $columns
     * @param bool $force
     * @param int $limit
     *
     * @return int
     *
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    public static function destroyFromQuery(
        object $query,
        array|string|null $columns = null,
        bool $force = false,
        int $limit = 1000,
    ): int {
        $count = 0;

        if (null === $columns) {
            $model = self::getModelFromQuery($query);
            $columns = [$model->getQualifiedKeyName()];
        } elseif (is_string($columns)) {
            $columns = [$columns];
        } elseif (!is_array($columns)) {
            throw new InvalidArgumentException('Columns must be as string, array or null');
        }

        $deleteMethod = $force ? 'forceDelete' : 'delete';

        $query->select($columns)->limit($limit);

        do {
            $models = (clone $query)->get();

            foreach ($models as $model) {
                $count += (int) $model->{$deleteMethod}();
            }
        } while ($models->count() === $limit);

        return $count;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $child
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string|null $foreignKey
     * @param string|null $ownerKey
     *
     * @return bool
     */
    public static function doesBelongTo(
        Model $child,
        Model $parent,
        ?string $foreignKey = null,
        ?string $ownerKey = null,
    ): bool {
        $foreignKey = $foreignKey ?? $parent->getForeignKey();
        $ownerKey = $ownerKey ?? $parent->getKeyName();

        return $child->getAttribute($foreignKey) === $parent->getAttribute($ownerKey);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $morphed
     * @param \Illuminate\Database\Eloquent\Model $parent
     * @param string $name
     * @param string|null $type
     * @param string|null $id
     *
     * @return bool
     */
    public static function doesMorphedBelongToParent(
        Model $morphed,
        Model $parent,
        string $name,
        ?string $type = null,
        ?string $id = null,
    ): bool {
        $type = $type ?: "{$name}_type";
        $id = $id ?: "{$name}_id";

        return $morphed->getAttribute($type) === $parent::class &&
            $morphed->getAttribute($id) === $parent->getKey();
    }
}
