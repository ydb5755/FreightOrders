<?php

namespace Tests\Unit\Carrier\UseCases;

use PHPUnit\Framework\TestCase;
use Tests\Fakes\Carrier\FakeCarrierRepository;
use FreightQuote\Carrier\UseCases\CreateCarrier;
use FreightQuote\Carrier\UseCases\CreateCarrierRequest;

class CreateCarrierTest extends TestCase
{
    public function test_carrier_is_created(): void
    {
        $email = 'joe@shmoe.com';
        $carrierRepo = new FakeCarrierRepository();
        $dto = new CreateCarrierRequest(null, $email);
        $useCase = new CreateCarrier($dto, $carrierRepo);
        $response = $useCase->execute();
        $foundCarrier = $carrierRepo->find($response->getId());
        $this->assertEquals($email, $foundCarrier->getEmail());
    }
}
