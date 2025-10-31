<?php

use DI\Bridge\Slim\Bridge;
use Slim\Csrf\Guard as CsrfMiddleware;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use FreightQuote\User\UserController;
use FreightQuote\MiddleWare\AuthMiddleware;
use FreightQuote\MiddleWare\CsrfToTwigMiddleware;

$container = require __DIR__.'/container.php';
$app = Bridge::create($container);

$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);

$responseFactory = $app->getResponseFactory();
$csrf = new CsrfMiddleware($responseFactory);
$csrfTwig = new CsrfToTwigMiddleware($twig);
$auth = new AuthMiddleware();
$app->add($csrf);
$app->add($csrfTwig);
$app->add(TwigMiddleware::create($app, $twig));
$app->addErrorMiddleware(true, false, false);

$app->get('/', [UserController::class, 'home']);
$app->get('/login', [UserController::class, 'login']);
$app->post('/login', [UserController::class, 'doLogin']);
$app->get('/dashboard', [UserController::class, 'dashboard'])->add($auth);

return $app;
