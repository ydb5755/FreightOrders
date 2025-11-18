<?php

namespace FreightQuote\Carrier;

interface CarrierRepository
{
    public function find(int $id): ?Carrier;
    public function findByEmail(string $email): ?Carrier;
    public function save(Carrier $carrier): Carrier;

    /**
     * @return Carrier[]
     */
    public function getAll(): array;
}
