<?php

declare(strict_types = 1);

namespace McMatters\Helpers\Helpers;

use InvalidArgumentException;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Illuminate\Support\Debug\HtmlDumper;
use const false, null, PHP_SAPI;
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
        $dumper = null;

        if ('cli' === PHP_SAPI && class_exists(CliDumper::class)) {
            $dumper = new CliDumper();
        } elseif (class_exists(HtmlDumper::class)) {
            $dumper = new HtmlDumper();
        }

        if (null !== $dumper) {
            $varCloner = new VarCloner;

            $dumper->dump($varCloner->cloneVar($value), $output);
        } else {
            var_dump($value);
        }
    }
}
