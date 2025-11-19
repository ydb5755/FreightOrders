<?php

namespace Tests\Unit\Bid\UseCases;

use FreightQuote\Bid\UseCases\GetBidForCarrier;
use FreightQuote\Bid\UseCases\GetBidForCarrierRequest;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Tests\Fakes\Bid\FakeBidRepository;

class GetBidForCarrierTest extends TestCase
{
    public function test_nonexistant_bid_throws_error(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $bidId = '12345abcd';
        $dto = new GetBidForCarrierRequest($bidId);
        $bidRepo = new FakeBidRepository();
        $useCase = new GetBidForCarrier($bidRepo);
        $foundBid = $useCase->execute($dto);
    }
}
