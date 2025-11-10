<?php

namespace FreightQuote\Carrier;

use FreightQuote\Carrier\UseCases\CreateCarrier;
use FreightQuote\Carrier\UseCases\CreateCarrierRequest;
use FreightQuote\Carrier\UseCases\GetAllCarriers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CarrierController
{
    public function __construct(
        private CarrierRepository $carrierRepo,
    ) {}

    public function page(Request $request, Response $response): Response
    {
        $twig = Twig::fromRequest($request);

        $useCase = new GetAllCarriers($this->carrierRepo);
        $result = $useCase->execute();

        return $twig->render($response, 'carriers.html.twig', [
            'carriers' => $result,
        ]);
    }

    public function create(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $dto = new CreateCarrierRequest(
            $body['email'],
            $body['company_name'],
            $body['contact_person'],
            $body['phone_number'],
            $body['notes'],
        );
        $useCase = new CreateCarrier($dto, $this->carrierRepo);
        $useCase->execute();

        return $response->withHeader('Location', '/freight_carriers')->withStatus(303);
    }
}
