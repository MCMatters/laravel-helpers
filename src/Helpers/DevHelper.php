<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use InvalidArgumentException;
use const false, null;
use function class_exists, var_dump;

/**
 * Class DevHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class DevHelper
{
    /**
     * @param mixed $query
     * @param bool $die
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public static function ddq($query, bool $die = false): string
    {
        $sql = DBHelper::compileSqlQuery($query);

        if ($die) {
            self::dump($sql);

            die(1);
        }

        return $sql;
    }

    /**
     * @param mixed $value
     * @param bool $output
     *
     * @return void
     */
    public static function dump($value, bool $output = false)
    {
        if (class_exists('Symfony\Component\VarDumper\Dumper\CliDumper') ||
            class_exists('Illuminate\Support\Debug\HtmlDumper')
        ) {
            $dumper = null;

            if ('cli' === PHP_SAPI) {
                $dumper = new Symfony\Component\VarDumper\Dumper\CliDumper();
            } else {
                $dumper = new Illuminate\Support\Debug\HtmlDumper();
            }

            if (null === $dumper) {
                var_dump($value);
            } else {
                $varCloner = new Symfony\Component\VarDumper\Cloner\VarCloner;

                $dumper->dump($varCloner->cloneVar($value), $output);
            }
        } else {
            var_dump($value);
        }
    }
}
