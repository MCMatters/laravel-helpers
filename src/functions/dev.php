<?php

declare(strict_types = 1);

if (!function_exists('ddq')) {
    /**
     * Debug queries.
     *
     * @param $query
     * @param bool $return
     *
     * @return mixed
     */
    function ddq($query, bool $return = true)
    {
        $string = compile_sql_query($query->toSql(), $query->getBindings());

        if ($return) {
            return $string;
        }

        dd($string);
    }
}

if (!function_exists('dump')) {
    /**
     * Wrapper under dd.
     *
     * @param mixed $value
     * @param bool $output
     *
     * @throws Exception
     */
    function dump($value, $output = false)
    {
        if (class_exists(Symfony\Component\VarDumper\Dumper\CliDumper::class)) {
            $dumper = 'cli' === PHP_SAPI
                ? new Symfony\Component\VarDumper\Dumper\CliDumper
                : new Illuminate\Support\Debug\HtmlDumper;
            $varCloner = new Symfony\Component\VarDumper\Cloner\VarCloner;
            $dumper->dump($varCloner->cloneVar($value), $output);
        } else {
            var_dump($value);
        }
    }
}
