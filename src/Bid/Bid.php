<?php

namespace FreightQuote\Bid;

class Bid
{
    public function __construct(
        private ?string $id,
        private int $freightOrderId,
        private int $carrierId,
        private bool $wasOpened,
        private bool $isClosed,
        private ?int $cost,
        private ?string $notes,
        private ?array $fileAttachments,
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

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    public function getFileAttachments(): ?array
    {
        return $this->fileAttachments;
    }

    public function setFileAttachments(array $attachments): void
    {
        $this->fileAttachments = $attachments;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }

    public function setIsClosed(bool $isClosed): void
    {
        $this->isClosed = $isClosed;
    }
}
