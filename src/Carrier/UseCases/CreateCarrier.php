<?php

namespace FreightQuote\Carrier\UseCases;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;
use InvalidArgumentException;

class CreateCarrier
{
    public function __construct(
        private CarrierRepository $carrierRepo,
    ) {}

    public function execute(CreateCarrierRequest $dto): Carrier
    {
        if ($this->carrierRepo->findByEmail($dto->email) !== null) {
            throw new InvalidArgumentException();
        }
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
