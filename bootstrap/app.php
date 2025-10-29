<?php

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use FreightQuote\User\UserController;

$container = require __DIR__.'/container.php';

$app = AppFactory::createFromContainer($container);

$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));
$app->addErrorMiddleware(true, false, false);

$app->get('/', [UserController::class, 'home']);

return $app;
