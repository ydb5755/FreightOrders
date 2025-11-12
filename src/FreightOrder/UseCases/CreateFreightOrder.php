<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\FreightOrder\FreightOrderRepository;
use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrder
{
    public function __construct(
        private FreightOrderRepository $freightOrderRepo,
    ) {}

    public function execute(
        CreateFreightOrderRequestDTO $dto,
    ): FreightOrder {
        return $this->freightOrderRepo->save(
            new FreightOrder(
                null,
                $dto->shipFrom,
                $dto->shipTo,
                $dto->pickupDate,
                $dto->deliveryDeadline,
                $dto->loadDetails,
                $dto->notes,
                $dto->fileAttachments,
            ));
    }
}
