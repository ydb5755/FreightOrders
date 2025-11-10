<?php

namespace Tests\Unit\Carrier\UseCases;

use FreightQuote\Carrier\Carrier;
use PHPUnit\Framework\TestCase;
use FreightQuote\Carrier\UseCases\GetAllCarriers;
use Tests\Fakes\Carrier\FakeCarrierRepository;

class GetAllCarriersTest extends TestCase
{
    public function test_get_one_carrier(): void
    {
        $email = 'email@email.com';
        $company = 'test Company';
        $contactPerson = 'joe shmoe';
        $phoneNumber = '123456798';
        $notes = 'some notes';
        $repo = new FakeCarrierRepository();
        $repo->save(new Carrier(
            0,
            $email,
            $company,
            $contactPerson,
            $phoneNumber,
            $notes,
        ));
        $useCase = new GetAllCarriers($repo);
        $response = $useCase->execute();
        $this->assertEquals(
            [new Carrier(
                0,
                $email,
                $company,
                $contactPerson,
                $phoneNumber,
                $notes,
            )],
            $response
        );
    }

    public function test_get_zero_carriers(): void
    {
        $repo = new FakeCarrierRepository();
        $useCase = new GetAllCarriers($repo);
        $response = $useCase->execute();
        $this->assertEquals([], $response);
    }
}
