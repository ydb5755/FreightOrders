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
        $carrier = new Carrier($this->dto->id, $this->dto->email);

        return $this->carrierRepo->save($carrier); 
    }
}
