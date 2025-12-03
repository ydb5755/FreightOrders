<?php

namespace Tests\Unit\Bid\UseCases;

use FreightQuote\Bid\Bid;
use FreightQuote\Bid\UseCases\UpdateBid;
use FreightQuote\Bid\UseCases\UpdateBidRequest;
use PHPUnit\Framework\TestCase;
use Tests\Fakes\Bid\FakeBidRepository;

class UpdateBidTest extends TestCase
{
    public function test_update(): void
    {
        $bidRepo = new FakeBidRepository();
        $bidRepo->save(new Bid(
            0, 0, 0, false, false, null, null, null
        ));
        $useCase = new UpdateBid($bidRepo);
        $dto = new UpdateBidRequest(
            bidId: 0,
            isClosed: true,
            cost: 1,
            notes: 'some notes',
            fileAttachments: ['/path/to/file'],
            
        );
        $useCase->execute($dto);
        $bid = $bidRepo->find(0);
        $this->assertEquals(true, $bid->isClosed());
        $this->assertEquals(1, $bid->getCost());
        $this->assertEquals('some notes', $bid->getNotes());
        $this->assertEquals(['/path/to/file'], $bid->getFileAttachments());
    }
}
