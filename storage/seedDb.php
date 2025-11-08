<?php

$users = [
    [
        'email' => 'test@test.com',
        'password' => password_hash('password', PASSWORD_DEFAULT),
    ],
];

$carriers = [
    [
        'id' => 0,
        'email' => 'carrier@test.com',
        'companyName' => 'test Company',
    ],
];

$fileDataMap = [
    'users.json' => $users,
    'carriers.json' => $carriers,
];

foreach ($fileDataMap as $file => $data) {
    $path = __DIR__."/$file";
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}
