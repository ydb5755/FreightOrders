<?php

namespace FreightQuote\FreightOrder\UseCases;

use DateTime;

class CreateFreightOrderRequestDTO
{
    public function __construct(
        public string $shipFrom,
        public string $shipTo,
        public DateTime $pickupDate,
        public DateTime $deliveryDeadline,
        public string $loadDetails,
        public string $notes,
        public array $fileAttachments,
    ) {}
}
