<?php

namespace FreightQuote\Carrier\UseCases;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;

class CreateCarrier
{
    public function __construct(
        private CreateCarrierRequest $dto,
        private CarrierRepository $carrierRepo,
    ) {}

    public function execute(): Carrier
    {
        $carrier = new Carrier(
            null,
            $this->dto->email,
            $this->dto->companyName,
            $this->dto->contactPerson,
            $this->dto->phoneNumber,
            $this->dto->notes,
            $this->dto->loadProfile,
            $this->dto->countriesServing,
        );

        return $this->carrierRepo->save($carrier);
    }
}
