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
        $company = 'test company';
        $contactPerson = 'Joe Shmoe';
        $phoneNumber = '132456798';
        $notes = 'some notes';
        $loadProfile = 'LTL/FTL'; // Less than full trailer load and full trailer load
        $countriesServing = ['USA', 'FRA', 'UK'];
        $carrierRepo = new FakeCarrierRepository();
        $dto = new CreateCarrierRequest(
            $email,
            $company,
            $contactPerson,
            $phoneNumber,
            $notes,
            $loadProfile,
            $countriesServing,
        );
        $useCase = new CreateCarrier($dto, $carrierRepo);
        $response = $useCase->execute();
        $foundCarrier = $carrierRepo->find($response->getId());
        $this->assertEquals($email, $foundCarrier->getEmail());
        $this->assertEquals($company, $foundCarrier->getCompanyName());
        $this->assertEquals($contactPerson, $foundCarrier->getContactPerson());
        $this->assertEquals($phoneNumber, $foundCarrier->getPhoneNumber());
        $this->assertEquals($notes, $foundCarrier->getNotes());
        $this->assertEquals($loadProfile, $foundCarrier->getLoadProfile());
        $this->assertEquals($countriesServing, $foundCarrier->getCountriesServing());
    }
}
