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

    public function login(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'login.html.twig');
    }

    public function doLogin(Request $request, Response $response): Response
    {
        $_SESSION['user_id'] = 1;
        $_SESSION['user']    = ['id' => 1, 'email' => 'email@email.com'];
        $location = '/dashboard';
        if(isset($_SESSION['intended'])) {
            $location = $_SESSION['intended'];
        }

        return $response->withHeader('Location', $location)->withStatus(302);
    }

    public function dashboard(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);

        return $view->render($response, 'dashboard.html.twig', [
            'name' => 'logged in',
        ]);
    }
}
