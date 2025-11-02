<?php

$users = [
    [
        'email' => 'test@test.com',
        'password' => password_hash('password', PASSWORD_DEFAULT),
    ],
];
$path = __DIR__.'/../storage/users.json';
$data = json_encode($users, JSON_PRETTY_PRINT);

file_put_contents($path, $data);
