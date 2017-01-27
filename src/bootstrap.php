<?php

declare(strict_types = 1);

$functions = [
    'database',
    'dev',
    'generic',
    'math',
    'strings',
    'array',
    'forms',
    'server',
    'class',
];

foreach ($functions as $file) {
    require_once __DIR__."/functions/{$file}.php";
}

$constants = [
    'mysql',
];

foreach ($constants as $file) {
    require_once __DIR__."/constants/{$file}.php";
}
