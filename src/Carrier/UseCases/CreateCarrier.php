<?php

namespace FreightQuote\Carrier\UseCases;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;

class CreateCarrier
{
    public function __construct(
        private CarrierRepository $carrierRepo,
    ) {}

    public function execute(CreateCarrierRequest $dto): Carrier
    {
        $carrier = new Carrier(
            null,
            $dto->email,
            $dto->companyName,
            $dto->contactPerson,
            $dto->phoneNumber,
            $dto->notes,
            $dto->loadProfile,
            $dto->countriesServing,
            [],
        );

        return $this->carrierRepo->save($carrier);
    }
}
