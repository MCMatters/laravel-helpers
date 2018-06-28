<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use InvalidArgumentException;
use const null;
use function get_class;

/**
 * Class ModelHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class ModelHelper
{
    /**
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \InvalidArgumentException
     */
    public static function getModelFromQuery($query): Model
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
     * @param mixed $query
     *
     * @return int
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    public static function destroyFromQuery($query): int
    {
        $count = 0;

        $model = self::getModelFromQuery($query);

        $query->select([$model->getQualifiedKeyName()])->each(
            function (Model $model) use (&$count) {
                $count += (int) $model->delete();
            }
        );

        return $count;
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
    public static function isMorphedBelongsParent(
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
