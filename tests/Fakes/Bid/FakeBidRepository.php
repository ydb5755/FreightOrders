<?php

namespace Tests\Fakes\Bid;

use FreightQuote\Bid\Bid;
use FreightQuote\Bid\BidRepository;

class FakeBidRepository implements BidRepository
{
    /**
     * @var Bid[]
     */
    private array $existingBids = [];

    public function save(Bid $bid): Bid
    {
        $id = $bid->getId();
        if ($id === null) {
            $id = $this->getUniqueId();
            $bid->setId($id);
        }
        $this->existingBids[$id] = $bid;

        return new Bid(
            $id,
            $bid->getFreightOrderId(),
            $bid->getCarrierId(),
        );
    }

    public function find(string $id): ?Bid
    {
        foreach ($this->existingBids as $bid) {
            if ($bid->getId() === $id) {
                return new Bid(
                    $id,
                    $bid->getFreightOrderId(),
                    $bid->getCarrierId(),
                );
            }
        }

        return null;
    }

    private function getUniqueId(): string
    {
        $id = uniqid('', true);
        while ($this->find($id) !== null) {
            $id = uniqid('', true);
        }
        return $id;
    }
}
