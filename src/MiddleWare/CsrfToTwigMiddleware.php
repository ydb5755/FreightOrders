<?php

namespace FreightQuote\MiddleWare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Views\Twig;

class CsrfToTwigMiddleware implements MiddlewareInterface
{
    public function __construct(private Twig $twig) {}

    public function process(Request $request, Handler $handler): Response
    {
        // These will be null on some requests (like first GET), so we guard it
        $nameKey  = $request->getAttribute('csrf_name');
        $valueKey = $request->getAttribute('csrf_value');

        $this->twig->getEnvironment()->addGlobal('csrf', [
            'name'  => $nameKey,
            'value' => $valueKey,
        ]);

        return $handler->handle($request);
    }
}
