<?php

namespace FreightQuote\Carrier\UseCases;

class CreateCarrierRequest
{
    public function __construct(
        public string $email,
        public string $companyName,
        public string $contactPerson,
        public string $phoneNumber,
        public string $notes,
        public string $loadProfile,
        public array $countriesServing,
    ) {}
}
