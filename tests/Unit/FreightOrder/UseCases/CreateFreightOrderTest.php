<?php

namespace Tests\Unit\FreightOrder\UseCases;

use PHPUnit\Framework\TestCase;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrder;
use FreightQuote\FreightOrder\UseCases\CreateFreightOrderRequestDTO;
use Tests\Fakes\FreightOrder\FakeFreightOrderRepository;

class CreateFreightOrderTest extends TestCase
{
    private CreateFreightOrderRequestDTO $dto;
    private FakeFreightOrderRepository $freightOrderRepo;
    private CreateFreightOrder $useCase;

    public function setUp(): void
    {
        $this->dto = new CreateFreightOrderRequestDTO();
        $this->freightOrderRepo = new FakeFreightOrderRepository();
        $this->useCase = new CreateFreightOrder($this->dto);
    }

    public function test_create_freight_order(): void
    {
        $createdFreightOrder = $this->useCase->execute();
        $this->assertNotNull($this->freightOrderRepo->find(
            $createdFreightOrder->getId()
        ));
    }
}
