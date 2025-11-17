<?php

namespace FreightQuote\Bid;

interface BidRepository
{
    public function save(Bid $bid): Bid;
}
