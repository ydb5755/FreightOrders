<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;

$container = require './container.php';

$app = AppFactory::createFromContainer($container);

$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

return $app;
