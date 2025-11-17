<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrderResponseDTO
{
    /**
     * @param Bid[] $bidsCreated
     */
    public function __construct(
        public FreightOrder $freightOrder,
        public array $bidsCreated,
    ) {}
}
