<?php

namespace FreightQuote\Bid\UseCases;

class UpdateBidRequest
{
    public function __construct(
        public int $bidId,
        public array $data,
    ) {}
}
