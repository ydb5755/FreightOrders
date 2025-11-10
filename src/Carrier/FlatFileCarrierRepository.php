<?php

namespace FreightQuote\Carrier;

class FlatFileCarrierRepository implements CarrierRepository
{
    private string $pathToCarrierFile = __DIR__.'/../../storage/carriers.json';

    private function getCarrierData(): array
    {
        $json = file_get_contents($this->pathToCarrierFile);

        return json_decode($json, true);
    }

    public function find(int $id): ?Carrier
    {
        return null;
    }

    public function save(Carrier $carrier): Carrier
    {
        $data = $this->getCarrierData();
        foreach ($data as $jsonCarrier) {
            if ($jsonCarrier['id'] === $carrier->getId()) {
                file_put_contents(
                    $this->pathToCarrierFile,
                    json_encode($data, JSON_PRETTY_PRINT)
                );
                return new Carrier(
                    $jsonCarrier['id'],
                    $jsonCarrier['email'],
                    $jsonCarrier['companyName'],
                    $jsonCarrier['contactPerson'],
                    $jsonCarrier['phoneNumber'],
                    $jsonCarrier['notes'],
                );
            }
        }
        $newCarrier = [
            'id' => $this->autoIncrementId($data),
            'email' => $carrier->getEmail(),
            'companyName' => $carrier->getCompanyName(),
            'contactPerson' => $carrier->getContactPerson(),
            'phoneNumber' => $carrier->getPhoneNumber(),
            'notes' => $carrier->getNotes(),
        ];
        $data[] = $newCarrier;
        file_put_contents(
            $this->pathToCarrierFile,
            json_encode($data, JSON_PRETTY_PRINT)
        );
        return new Carrier(
            $newCarrier['id'],
            $newCarrier['email'],
            $newCarrier['companyName'],
            $newCarrier['contactPerson'],
            $newCarrier['phoneNumber'],
            $newCarrier['notes'],
        );
    }

    /**
     * @return Carrier[]
     */
    public function getAll(): array
    {
        return array_map(function ($carrier) {
            return new Carrier(
                $carrier['id'],
                $carrier['email'],
                $carrier['companyName'],
                $carrier['contactPerson'],
                $carrier['phoneNumber'],
                $carrier['notes'],
            );
        }, $this->getCarrierData());
    }

    /**
     * @param array<int,mixed> $data
     */
    private function autoIncrementId(array $data): int
    {
        return count($data);
    }
}
