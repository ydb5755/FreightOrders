<?php

namespace FreightQuote\MiddleWare;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        if (isset($_SESSION['user_id'])) {
            return $handler->handle($request);
        }

        $uri = $request->getUri()->getPath();
        if ($uri !== '/login' && $uri !== '/logout') {
            $_SESSION['intended'] = $uri;
        }
        $resp = new SlimResponse(302);

        return $resp->withHeader('Location', '/login');
    }
}
