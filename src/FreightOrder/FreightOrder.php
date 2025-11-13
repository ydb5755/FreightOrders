<?php

namespace FreightQuote\FreightOrder;

use DateTime;

class FreightOrder
{
    public function __construct(
        private ?int $id,
        private string $shipFrom,
        private string $shipTo,
        private DateTime $pickupDate,
        private DateTime $deliveryDeadline,
        private string $loadDetails,
        private string $notes,
        private array $fileAttachments,
        private array $carrierIds,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getShipFrom(): string
    {
        return $this->shipFrom;
    }

    public function getShipTo(): string
    {
        return $this->shipTo;
    }

    public function getPickupDate(): DateTime
    {
        return $this->pickupDate;
    }

    public function getDeliveryDeadline(): DateTime
    {
        return $this->deliveryDeadline;
    }

    public function getLoadDetails(): string
    {
        return $this->loadDetails;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getFileAttachments(): array
    {
        return $this->fileAttachments;
    }

    public function getCarrierIds(): array
    {
        return $this->carrierIds;
    }
}
