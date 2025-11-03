<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrder
{
    public function execute(): ?FreightOrder
    {
        return new FreightOrder();
    }
}
