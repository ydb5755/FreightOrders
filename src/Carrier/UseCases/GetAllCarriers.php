<?php

namespace FreightQuote\Carrier\UseCases;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;

class GetAllCarriers
{
    public function __construct(
        private CarrierRepository $carrierRepo,
    ) {}

    /**
     * @return Carrier[]
     */
    public function execute(): array
    {
        return $this->carrierRepo->getAll();
    }
}
