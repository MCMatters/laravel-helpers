<?php

declare(strict_types = 1);

return [
    'int'    => [
        'foo',
        'bar',
        'baz',
        'test',
    ],
    'int2'   => [
        20    => 'foo',
        '324' => 'bar',
        '543' => 'baz',
        45223 => 'test',
    ],
    'float'  => [
        20        => 'foo',
        '21.0'    => 'bar',
        '2424.53' => 'baz',
    ],
    'string' => [
        'foo' => 'bar',
        'baz' => 'foo',
    ],
];
