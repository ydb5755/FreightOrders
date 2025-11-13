<?php

namespace Tests\Fakes\Carrier;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;

class FakeCarrierRepository implements CarrierRepository
{
    /**
     * @var Carrier[]
     */
    private array $existingCarriers = [];

    public function find(int $id): ?Carrier
    {
        foreach ($this->existingCarriers as $carrier) {
            if ($carrier->getId() === $id) {
                return new Carrier(
                    $id,
                    $carrier->getEmail(),
                    $carrier->getCompanyName(),
                    $carrier->getContactPerson(),
                    $carrier->getPhoneNumber(),
                    $carrier->getNotes(),
                    $carrier->getLoadProfile(),
                    $carrier->getCountriesServing(),
                    $carrier->getFreightOrderIds(),
                );
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

        return new Carrier(
            $id,
            $carrier->getEmail(),
            $carrier->getCompanyName(),
            $carrier->getContactPerson(),
            $carrier->getPhoneNumber(),
            $carrier->getNotes(),
            $carrier->getLoadProfile(),
            $carrier->getCountriesServing(),
            $carrier->getFreightOrderIds(),
        );
    }

    private function autoIncrementId(): int
    {
        return count($this->existingCarriers);
    }

    public function getAll(): array
    {
        return array_map(function (Carrier $carrier) {
            return new Carrier(
                $carrier->getId(),
                $carrier->getEmail(),
                $carrier->getCompanyName(),
                $carrier->getContactPerson(),
                $carrier->getPhoneNumber(),
                $carrier->getNotes(),
                $carrier->getLoadProfile(),
                $carrier->getCountriesServing(),
                $carrier->getFreightOrderIds(),
            );
        }, $this->existingCarriers);
    }
}
