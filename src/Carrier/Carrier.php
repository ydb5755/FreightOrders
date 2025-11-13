<?php

namespace FreightQuote\Carrier;

class Carrier
{
    public function __construct(
        private ?int $id,
        private string $email,
        private string $companyName,
        private string $contactPerson,
        private string $phoneNumber,
        private string $notes,
        private string $loadProfile,
        private array $countriesServing,
        private array $freightOrderIds,
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

    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function getLoadProfile(): string
    {
        return $this->loadProfile;
    }

    public function getCountriesServing(): array
    {
        return $this->countriesServing;
    }

    public function getFreightOrderIds(): array
    {
        return $this->freightOrderIds;
    }
}
