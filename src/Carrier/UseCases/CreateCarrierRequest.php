<?php

namespace FreightQuote\Carrier\UseCases;

class CreateCarrierRequest
{
    public function __construct(
        public string $email,
        public string $companyName,
    ) {}
}
