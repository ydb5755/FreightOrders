<?php

namespace Tests\Unit\FreightOrder\UseCases;

use PHPUnit\Framework\TestCase;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrder;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrderRequestDTO;
use Tests\Fakes\FreightOrder\FakeFreightOrderRepository;
use DateTime;

class CreateFreightOrderTest extends TestCase
{
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
        );
        $freightOrderRepo = new FakeFreightOrderRepository();
        $useCase = new CreateFreightOrder($freightOrderRepo);
        $createdFreightOrder = $useCase->execute($dto);
        $foundFreightOrder = $freightOrderRepo->find(
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
}
