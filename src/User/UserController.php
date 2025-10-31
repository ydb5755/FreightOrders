<?php

namespace FreightQuote\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class UserController
{
    public function home(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'home.html.twig', [
            'name' => 'name'
        ]);
    }
}
