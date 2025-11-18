<?php

namespace Tests\Fakes\FreightOrder;

use FreightQuote\FreightOrder\FreightOrderRepository;
use FreightQuote\FreightOrder\FreightOrder;

class FakeFreightOrderRepository implements FreightOrderRepository
{
    /**
     * @var FreightOrder[]
     */
    private array $existingFreightOrders = [];

    public function find(int $id): ?FreightOrder
    {
        foreach ($this->existingFreightOrders as $freightOrder) {
            if ($freightOrder->getId() === $id) {
                return new FreightOrder(
                    $freightOrder->getId(),
                    $freightOrder->getShipFrom(),
                    $freightOrder->getShipTo(),
                    $freightOrder->getPickupDate(),
                    $freightOrder->getDeliveryDeadline(),
                    $freightOrder->getLoadDetails(),
                    $freightOrder->getNotes(),
                    $freightOrder->getFileAttachments(),
                );
            }
        }

        return null;
    }

    public function save(FreightOrder $freightOrder): FreightOrder
    {
        $id = $freightOrder->getId();
        if ($id === null) {
            $id = $this->getNextId();
            $freightOrder->setId($id);
        }
        $this->existingFreightOrders[$id] = $freightOrder;
        return new FreightOrder(
            $freightOrder->getId(),
            $freightOrder->getShipFrom(),
            $freightOrder->getShipTo(),
            $freightOrder->getPickupDate(),
            $freightOrder->getDeliveryDeadline(),
            $freightOrder->getLoadDetails(),
            $freightOrder->getNotes(),
            $freightOrder->getFileAttachments(),
        );
    }

    private function getNextId(): int
    {
        return count($this->existingFreightOrders);
    }
}
