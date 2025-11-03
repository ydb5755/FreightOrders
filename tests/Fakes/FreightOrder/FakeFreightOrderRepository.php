<?php

namespace Tests\Fakes\FreightOrder;

use FreightQuote\FreightOrder\FreightOrder;

class FakeFreightOrderRepository
{
    public function find(): ?FreightOrder
    {
        return new FreightOrder();
    }
}
