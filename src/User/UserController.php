<?php

namespace FreightQuote\User;

use FreightQuote\User\UseCases\LoginUser;
use FreightQuote\User\UseCases\LoginUserRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class UserController
{
    public function __construct(
        private UserRepository $userRepo,
    ) {}

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
        $view = Twig::fromRequest($request);
        $body = $request->getParsedBody();
        $email = $body['email'];
        $password = $body['password'];
        $useCase = new LoginUser(
            new LoginUserRequest($email, $password),
            $this->userRepo,
        );
        $result = $useCase->execute();
        if (!$result) {
            return $view->render($response, 'login.html.twig')
                ->withStatus(401);
        }
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
