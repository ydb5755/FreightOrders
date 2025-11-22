<?php

namespace Tests\Unit\Bid\UseCases;

use FreightQuote\Bid\Bid;
use FreightQuote\Bid\UseCases\GetBidForCarrier;
use FreightQuote\Bid\UseCases\GetBidForCarrierRequest;
use FreightQuote\Bid\UseCases\GetBidForCarrierResponse;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Tests\Fakes\Bid\FakeBidRepository;

class GetBidForCarrierTest extends TestCase
{
    private FakeBidRepository $bidRepo;
    private GetBidForCarrier $useCase;

    public function setUp(): void
    {
        $this->bidRepo = new FakeBidRepository();
        $this->useCase = new GetBidForCarrier($this->bidRepo);
    }

    public function test_nonexistant_bid_throws_error(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $bidId = '12345abcd';
        $dto = new GetBidForCarrierRequest($bidId);
        $this->useCase->execute($dto);
    }

    public function test_first_view_flips_opened_flag(): void
    {
        $bidId = 'abcd';
        $this->bidRepo->save(new Bid(
            $bidId,
            0,
            0,
            false,
            false,
            null,
            null,
            null,
        ));
        $response = $this->useCase->execute(
            new GetBidForCarrierRequest($bidId)
        );
        $this->assertEquals(true, $response->bid->getWasOpened());
    }

    public function test_getting_closed_bid_returns_response_with_null_bid(): void
    {
        $this->bidRepo->save(new Bid(
            0,
            0,
            0,
            false,
            true,
            null,
            null,
            null,
        ));
        $response = $this->useCase->execute(
            new GetBidForCarrierRequest(0),
        );
        $this->assertInstanceOf(
            GetBidForCarrierResponse::class,
            $response
        );
        $this->assertNull($response->bid);
        $this->assertTrue($response->isClosed);
    }
}
