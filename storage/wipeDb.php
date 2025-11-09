<?php

$files = [
    'users.json',
    'carriers.json',
];

foreach ($files as $file) {
    $path = __DIR__."/$file";
    file_put_contents($path, json_encode([], JSON_PRETTY_PRINT));
}
