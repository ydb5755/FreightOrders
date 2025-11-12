<?php

namespace FreightQuote\FreightOrder;

interface FreightOrderRepository
{
    public function find(int $id): ?FreightOrder;

    public function save(FreightOrder $freightOrder): FreightOrder;
}
