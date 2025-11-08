<?php

namespace FreightQuote\Carrier;

class FlatFileCarrierRepository implements CarrierRepository
{
    public function find(int $id): ?Carrier
    {
        return null;
    }

    public function save(Carrier $carrier): Carrier
    {
        return new Carrier(null, 'fake@email.com');
    }
}
