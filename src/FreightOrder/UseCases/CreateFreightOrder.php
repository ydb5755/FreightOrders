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
        $savedFreightOrder = $this->saveFreightOrder($dto);
        $this->updateCarriers(
            $dto->carrierIds,
            $savedFreightOrder->getId()
        );

        return $savedFreightOrder;
    }

    /**
     * @param int[] $carrierIds
     */
    private function updateCarriers(
        array $carrierIds,
        int $freightOrderId
    ): void {
        foreach ($carrierIds as $carrierId) {
            $carrier = $this->carrierRepo->find($carrierId);
            $carrierFreightOrderIds = $carrier->getFreightOrderIds();
            $carrierFreightOrderIds[] = $freightOrderId;
            $carrier->setFreightOrderIds($carrierFreightOrderIds);
            $this->carrierRepo->save($carrier);
        }
    }

    private function saveFreightOrder(
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
