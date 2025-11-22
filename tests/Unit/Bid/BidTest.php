<?php

namespace Tests\Unit\Bid;

use FreightQuote\Bid\Bid;
use PHPUnit\Framework\TestCase;

class BidTest extends TestCase
{
    public function test_bid_link_generated(): void
    {
        $bidId = '124e56abf82';
        $bid = new Bid(
            $bidId,
            0,
            0,
            false,
            false,
            null,
            null,
            null
        );
        $this->assertEquals(
            "https://freightquotes.com/bid/$bidId",
            $bid->getBidLink()
        );
    }
}
