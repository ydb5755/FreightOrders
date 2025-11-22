<?php

namespace FreightQuote\Bid\UseCases;

use FreightQuote\Bid\Bid;

class GetBidForCarrierResponse
{
    public function __construct(
        public bool $isClosed,
        public ?Bid $bid,
    ) {}
}
