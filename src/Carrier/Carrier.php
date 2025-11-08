<?php

namespace FreightQuote\Carrier;

class Carrier
{
    public function __construct(
        private ?int $id,
        private string $email,
        private string $companyName,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }
}
