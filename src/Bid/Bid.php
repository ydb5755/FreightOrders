<?php

namespace FreightQuote\Bid;

class Bid
{
    public function __construct(
        private ?string $id,
        private int $freightOrderId,
        private int $carrierId,
    ) {}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFreightOrderId(): int
    {
        return $this->freightOrderId;
    }

    public function getCarrierId(): int
    {
        return $this->carrierId;
    }
}
