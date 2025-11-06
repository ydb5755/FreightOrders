<?php

namespace FreightQuote\Carrier\UseCases;

class CreateCarrierRequest
{
    public function __construct(
        public ?int $id,
        public string $email,
    ) {}
}
