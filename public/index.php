<?php
session_start([
  'cookie_httponly' => true,
  'cookie_secure'   => !empty($_SERVER['HTTPS']),
  'cookie_samesite' => 'Lax',
]);

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';


$app->run();
