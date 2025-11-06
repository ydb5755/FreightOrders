<?php

namespace FreightQuote\Carrier;

interface CarrierRepository
{
    public function find(int $id): ?Carrier;
    public function save(Carrier $carrier): Carrier;
}
