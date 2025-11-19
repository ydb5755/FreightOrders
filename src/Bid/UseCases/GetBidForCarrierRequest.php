<?php

namespace FreightQuote\Bid\UseCases;

class GetBidForCarrierRequest
{
    public function __construct(
        public string $id,
    ) {}
}
