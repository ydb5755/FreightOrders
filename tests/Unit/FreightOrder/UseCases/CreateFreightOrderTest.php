<?php

namespace Tests\Unit\FreightOrder\UseCases;

use FreightQuote\Carrier\Carrier;
use PHPUnit\Framework\TestCase;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrder;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrderRequestDTO;
use Tests\Fakes\Carrier\FakeCarrierRepository;
use Tests\Fakes\FreightOrder\FakeFreightOrderRepository;
use DateTime;

class CreateFreightOrderTest extends TestCase
{
    private FakeFreightOrderRepository $freightOrderRepo;
    private FakeCarrierRepository $carrierRepo;
    private CreateFreightOrder $useCase;

    public function setUp(): void
    {
        $this->freightOrderRepo = new FakeFreightOrderRepository();
        $this->carrierRepo = new FakeCarrierRepository();
        $this->useCase = new CreateFreightOrder($this->freightOrderRepo);
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
            carrierIds: [0, 1, 2],
        );
        $createdFreightOrder = $this->useCase->execute($dto);
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
        $this->assertEquals($dto->carrierIds, $foundFreightOrder->getCarrierIds());
    }

    public function test_carrier_is_connected_to_order(): void
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
            freightOrderIds: [],
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
        $createdFreightOrder = $this->useCase->execute($dto);
        $foundCarrier = $this->carrierRepo->find($carrierId);
        $this->assertEquals(
            [$createdFreightOrder->getId()],
            $foundCarrier->getFreightOrderIds()
        );
    }
}
