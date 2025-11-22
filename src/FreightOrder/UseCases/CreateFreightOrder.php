<?php

namespace FreightQuote\FreightOrder\UseCases;

use FreightQuote\Bid\Bid;
use FreightQuote\Bid\BidRepository;
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
        private BidRepository $bidRepo,
        private Emailer $emailer,
    ) {}

    public function execute(
        CreateFreightOrderRequestDTO $dto,
    ): CreateFreightOrderResponseDTO {
        $savedFreightOrder = $this->saveFreightOrder($dto);
        $bidsCreated = $this->handleCarrierActions(
            $dto->carrierIds,
            $savedFreightOrder,
        );

        return new CreateFreightOrderResponseDTO(
            $savedFreightOrder,
            $bidsCreated
        );
    }

    /**
     * @param int[] $carrierIds
     * @return Bid[]
     */
    private function handleCarrierActions(
        array $carrierIds,
        FreightOrder $freightOrder,
    ): array {
        $bidsCreated = [];
        foreach ($carrierIds as $carrierId) {
            $carrier = $this->carrierRepo->find($carrierId);
            $freightOrderId = $freightOrder->getId();
            $createdBid = $this->createBid(
                $freightOrderId,
                $carrier->getId(),
            );
            $this->sendEmail(
                $carrier->getEmail(),
                $freightOrder,
                $createdBid->getBidLink(),
            );
            $bidsCreated[] = $createdBid;
        }

        return $bidsCreated;
    }

    private function createBid(
        int $freightOrderId,
        int $carrierId
    ): Bid {
        return $this->bidRepo->save(
            new Bid(
                id: null,
                freightOrderId: $freightOrderId,
                carrierId: $carrierId,
                wasOpened: false,
                isClosed: false,
                cost: null,
                notes: null,
                fileAttachments: null,
            )
        );
    }

    private function sendEmail(
        string $emailAddress,
        FreightOrder $freightOrder,
        string $bidLink,
    ): void {
        $email = new Email();
        $email->addRecipient($emailAddress);
        $email->setSubject('Freight Order Request');
        $email->setBody("Please fill out your bid at this link $bidLink");
        foreach ($freightOrder->getFileAttachments() as $file) {
            $email->addAttachment($file);
        }
        $this->emailer->send($email);
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
                $dto->dateCreated,
            ));
    }
}
