<?php

namespace Tests\Fakes\Carrier;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;

class FakeCarrierRepository implements CarrierRepository
{
    private array $existingCarriers = [];

    public function find(int $id): ?Carrier
    {
        foreach ($this->existingCarriers as $carrier) {
            if ($carrier->getId() === $id) {
                return new Carrier($id, $carrier->getEmail());
            }
        }

        return null;
    }

    public function save(Carrier $carrier): Carrier
    {
        $id = $carrier->getId();
        if ($id === null) {
            $id = $this->autoIncrementId();
            $carrier->setId($id);
        }
        $this->existingCarriers[$id] = $carrier;

        return new Carrier($id, $carrier->getEmail());
    }

    private function autoIncrementId(): int
    {
        return count($this->existingCarriers);
    }
}
