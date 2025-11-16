<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\Carrier\CarrierRepository;
use FreightQuote\FreightOrder\FreightOrderRepository;
use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrder
{
    public function __construct(
        private FreightOrderRepository $freightOrderRepo,
        private CarrierRepository $carrierRepo,
    ) {}

    public function execute(
        CreateFreightOrderRequestDTO $dto,
    ): FreightOrder {
        $savedFreightOrder = $this->constructFreightOrder($dto);
        foreach ($dto->carrierIds as $carrierId) {
            $this->updateCarrier(
                $carrierId,
                $savedFreightOrder->getId()
            );
        }

        return $savedFreightOrder;
    }

    private function updateCarrier(
        int $carrierId,
        int $freightOrderId
    ): void {
        $carrier = $this->carrierRepo->find($carrierId);
        $carrierFreightOrderIds = $carrier->getFreightOrderIds();
        $carrierFreightOrderIds[] = $freightOrderId;
        $carrier->setFreightOrderIds($carrierFreightOrderIds);
        $this->carrierRepo->save($carrier);
    }

    private function constructFreightOrder(
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
                $dto->carrierIds,
            ));
    }
}
