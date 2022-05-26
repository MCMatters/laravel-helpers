<?php

declare(strict_types=1);

namespace McMatters\Helpers\Helpers;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Illuminate\Support\Debug\HtmlDumper;

use function class_exists;
use function var_dump;

use const false;
use const null;
use const PHP_SAPI;

/**
 * Class DevHelper
 *
 * @package McMatters\Helpers\Helpers
 */
class DevHelper
{
    /**
     * @param object $query
     * @param bool $die
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     * @throws \ErrorException
     */
    public static function ddq(object $query, bool $die = false): string
    {
        $sql = DbHelper::compileSqlQuery($query);

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
     *
     * @throws \ErrorException
     */
    public static function dump(mixed $value, bool $output = false): void
    {
        $dumper = null;

        if ('cli' === PHP_SAPI && class_exists(CliDumper::class)) {
            $dumper = new CliDumper();
        } elseif (class_exists(HtmlDumper::class)) {
            $dumper = new HtmlDumper();
        }

        if (null !== $dumper) {
            $varCloner = new VarCloner();

            $dumper->dump($varCloner->cloneVar($value), $output);
        } else {
            var_dump($value);
        }
    }
}
