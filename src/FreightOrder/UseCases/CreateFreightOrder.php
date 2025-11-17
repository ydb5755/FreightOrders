<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\Carrier\Carrier;
use FreightQuote\Carrier\CarrierRepository;
use FreightQuote\Email\Email;
use FreightQuote\Email\Emailer;
use FreightQuote\FreightOrder\FreightOrderRepository;
use FreightQuote\FreightOrder\FreightOrder;

class CreateFreightOrder
{
    public function __construct(
        private FreightOrderRepository $freightOrderRepo,
        private CarrierRepository $carrierRepo,
        private Emailer $emailer,
    ) {}

    public function execute(
        CreateFreightOrderRequestDTO $dto,
    ): CreateFreightOrderResponseDTO {
        $savedFreightOrder = $this->saveFreightOrder($dto);
        $this->handleCarrierActions(
            $dto->carrierIds,
            $savedFreightOrder,
        );

        return new CreateFreightOrderResponseDTO($savedFreightOrder);
    }

    /**
     * @param int[] $carrierIds
     */
    private function handleCarrierActions(
        array $carrierIds,
        FreightOrder $freightOrder
    ): void {
        foreach ($carrierIds as $carrierId) {
            $carrier = $this->carrierRepo->find($carrierId);
            $this->updateCarrierOrderIds($carrier, $freightOrder->getId());
            $this->sendEmail($carrier->getEmail(), $freightOrder);
        }
    }

    private function sendEmail(string $emailAddress, FreightOrder $freightOrder): void
    {
        $email = new Email();
        $email->addRecipient($emailAddress);
        $email->setSubject('Freight Order Request');
        $email->setBody('Please fill out your bid at this link xxxxxxx');
        foreach ($freightOrder->getFileAttachments() as $file) {
            $email->addAttachment($file);
        }
        $this->emailer->send($email);
    }

    private function updateCarrierOrderIds(
        Carrier $carrier,
        int $freightOrderId
    ): void {
        $carrierFreightOrderIds = $carrier->getFreightOrderIds();
        $carrierFreightOrderIds[] = $freightOrderId;
        $carrier->setFreightOrderIds($carrierFreightOrderIds);
        $this->carrierRepo->save($carrier);
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
