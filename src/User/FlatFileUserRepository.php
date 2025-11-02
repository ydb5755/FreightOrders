<?php

namespace FreightQuote\User;

class FlatFileUserRepository implements UserRepository
{
    private string $pathToUserFile = __DIR__.'/../../storage/users.json';

    private function getUserData(): array
    {
        $json = file_get_contents($this->pathToUserFile);
        $data = json_decode($json, true);

        return $data;
    }

    public function findByEmail(string $email): ?User
    {
        $data = $this->getUserData();
        foreach ($data as $user) {
            if ($user['email'] === $email) {
                return new User($user['email'], $user['password']);
            }
        }
    }

    public function save(User $user): User
    {
    }
}
