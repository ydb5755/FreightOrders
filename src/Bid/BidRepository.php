<?php

namespace FreightQuote\Bid;

interface BidRepository
{
    public function save(Bid $bid): Bid;
    public function find(string $id): ?Bid;
}
