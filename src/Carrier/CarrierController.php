<?php

namespace FreightQuote\Carrier;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CarrierController
{
    public function page(Request $request, Response $response): Response
    {
        $twig = Twig::fromRequest($request);

        return $twig->render($response, 'carriers.html.twig');
    }

    public function create(Request $request, Response $response): Response
    {
    }
}
