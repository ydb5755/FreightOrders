<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrderResponseDTO
{
    public function __construct(
        public FreightOrder $freightOrder,
    ) {}
}
