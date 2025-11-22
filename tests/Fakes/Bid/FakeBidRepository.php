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
            $bid->getWasOpened(),
            $bid->isClosed(),
            $bid->getCost(),
            $bid->getNotes(),
            $bid->getFileAttachments(),
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
                    $bid->getWasOpened(),
                    $bid->isClosed(),
                    $bid->getCost(),
                    $bid->getNotes(),
                    $bid->getFileAttachments(),
                );
            }
        }

        return null;
    }

    private function getUniqueId(): string
    {
        $id = bin2hex(random_bytes(10));
        while ($this->find($id) !== null) {
            $id = bin2hex(random_bytes(10));
        }
        return $id;
    }
}
