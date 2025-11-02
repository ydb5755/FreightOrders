<?php

namespace FreightQuote\User;

class FlatFileUserRepository implements UserRepository
{
    private string $pathToUserFile = __DIR__.'/../../storage/users.json';

    public function findByEmail(string $email): ?User
    {
        $json = file_get_contents($this->pathToUserFile);
        $data = json_decode($json, true);
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
