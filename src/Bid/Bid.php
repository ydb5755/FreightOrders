<?php

namespace FreightQuote\Bid;

class Bid
{
    public function __construct(
        private ?string $id,
        private int $freightOrderId,
        private int $carrierId,
        private bool $wasOpened,
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

    public function getBidLink(): ?string
    {
        $id = $this->id;
        if ($id === null) {
            return null;
        }
        return "https://freightquotes.com/bid/$id";
    }

    public function getWasOpened(): bool
    {
        return $this->wasOpened;
    }

    public function setWasOpened(bool $wasOpened): void
    {
        $this->wasOpened = $wasOpened;
    }
}
