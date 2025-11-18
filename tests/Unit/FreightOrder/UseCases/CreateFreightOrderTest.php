<?php

namespace Tests\Unit\FreightOrder\UseCases;

use FreightQuote\Bid\Bid;
use Tests\Fakes\Email\FakeEmailer;
use FreightQuote\Carrier\Carrier;
use PHPUnit\Framework\TestCase;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrder;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrderRequestDTO;
use Tests\Fakes\Carrier\FakeCarrierRepository;
use Tests\Fakes\FreightOrder\FakeFreightOrderRepository;
use Tests\Fakes\Bid\FakeBidRepository;
use DateTime;

class CreateFreightOrderTest extends TestCase
{
    private FakeEmailer $emailer;
    private FakeFreightOrderRepository $freightOrderRepo;
    private FakeCarrierRepository $carrierRepo;
    private FakeBidRepository $bidRepo;
    private CreateFreightOrder $useCase;

    public function setUp(): void
    {
        $this->emailer = new FakeEmailer();
        $this->freightOrderRepo = new FakeFreightOrderRepository();
        $this->carrierRepo = new FakeCarrierRepository();
        $this->bidRepo = new FakeBidRepository();
        $this->useCase = new CreateFreightOrder(
            $this->freightOrderRepo,
            $this->carrierRepo,
            $this->bidRepo,
            $this->emailer,
        );
    }

    public function test_create_freight_order(): void
    {
        $dto = new CreateFreightOrderRequestDTO(
            shipFrom: 'ny',
            shipTo: 'nj',
            pickupDate: new DateTime('+5 days'),
            deliveryDeadline: new DateTime('+10 days'),
            loadDetails: 'some details',
            notes: 'some notes',
            fileAttachments: ['path/to/file', 'another/path/file'],
            carrierIds: [],
        );
        $response = $this->useCase->execute($dto);
        $createdFreightOrder = $response->freightOrder;
        $foundFreightOrder = $this->freightOrderRepo->find(
            $createdFreightOrder->getId()
        );
        $this->assertNotNull($foundFreightOrder);
        $this->assertEquals($dto->shipFrom, $foundFreightOrder->getShipFrom());
        $this->assertEquals($dto->shipTo, $foundFreightOrder->getShipTo());
        $this->assertEquals($dto->pickupDate, $foundFreightOrder->getPickupDate());
        $this->assertEquals($dto->deliveryDeadline, $foundFreightOrder->getDeliveryDeadline());
        $this->assertEquals($dto->loadDetails, $foundFreightOrder->getLoadDetails());
        $this->assertEquals($dto->notes, $foundFreightOrder->getNotes());
        $this->assertEquals($dto->fileAttachments, $foundFreightOrder->getFileAttachments());
    }

    public function test_email_is_sent(): void
    {
        $carrierId = 0;
        $this->carrierRepo->save(new Carrier(
            id: $carrierId,
            email: 'test@email.com',
            companyName: 'company name',
            contactPerson: 'person',
            phoneNumber: '123456798',
            notes: 'some notes',
            loadProfile: 'LTL/FTL',
            countriesServing: ['USA'],
        ));
        $dto = new CreateFreightOrderRequestDTO(
            shipFrom: 'ny',
            shipTo: 'nj',
            pickupDate: new DateTime('+5 days'),
            deliveryDeadline: new DateTime('+10 days'),
            loadDetails: 'some details',
            notes: 'some notes',
            fileAttachments: ['path/to/file', 'another/path/file'],
            carrierIds: [$carrierId],
        );
        $this->useCase->execute($dto);
        $this->assertEquals(1, $this->emailer->getSentEmailCount());
    }

    public function test_multiple_emails_are_sent(): void
    {
        $this->carrierRepo->save(new Carrier(
            id: 0,
            email: 'test@email.com',
            companyName: 'company name',
            contactPerson: 'person',
            phoneNumber: '123456798',
            notes: 'some notes',
            loadProfile: 'LTL/FTL',
            countriesServing: ['USA'],
        ));
        $this->carrierRepo->save(new Carrier(
            id: 1,
            email: 'test@email.com',
            companyName: 'company name',
            contactPerson: 'person',
            phoneNumber: '123456798',
            notes: 'some notes',
            loadProfile: 'LTL/FTL',
            countriesServing: ['USA'],
        ));
        $dto = new CreateFreightOrderRequestDTO(
            shipFrom: 'ny',
            shipTo: 'nj',
            pickupDate: new DateTime('+5 days'),
            deliveryDeadline: new DateTime('+10 days'),
            loadDetails: 'some details',
            notes: 'some notes',
            fileAttachments: ['path/to/file', 'another/path/file'],
            carrierIds: [0, 1],
        );
        $this->useCase->execute($dto);
        $this->assertEquals(2, $this->emailer->getSentEmailCount());
    }

    public function test_bid_is_created(): void
    {
        $carrierId = 0;
        $this->carrierRepo->save(new Carrier(
            id: $carrierId,
            email: 'test@email.com',
            companyName: 'company name',
            contactPerson: 'person',
            phoneNumber: '123456798',
            notes: 'some notes',
            loadProfile: 'LTL/FTL',
            countriesServing: ['USA'],
        ));
        $dto = new CreateFreightOrderRequestDTO(
            shipFrom: 'ny',
            shipTo: 'nj',
            pickupDate: new DateTime('+5 days'),
            deliveryDeadline: new DateTime('+10 days'),
            loadDetails: 'some details',
            notes: 'some notes',
            fileAttachments: ['path/to/file', 'another/path/file'],
            carrierIds: [$carrierId],
        );
        $response = $this->useCase->execute($dto);
        $bid = $response->bidsCreated[0];
        $this->assertInstanceOf(Bid::class, $bid);
        $this->assertEquals(
            $response->freightOrder->getId(),
            $bid->getFreightOrderId()
        );
        $this->assertEquals($carrierId, $bid->getCarrierId());
    }
}
