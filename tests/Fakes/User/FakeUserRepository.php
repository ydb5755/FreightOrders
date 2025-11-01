<?php

namespace Tests\Fakes\User;

use FreightQuote\User\User;
use FreightQuote\User\UserRepository;

class FakeUserRepository implements UserRepository
{
    /**
     * @var User[] $existingUsers
     */
    private array $existingUsers = [];

    public function findByEmail(string $email): ?User
    {
        foreach ($this->existingUsers as $user) {
            if ($user->getEmail() === $email) {
                return new User(
                    $user->getEmail(),
                    $user->getPassword()
                );
            }
        }

        return null;
    }

    public function save(User $user): User
    {
        $this->existingUsers[$user->getEmail()] = $user;

        return new User($user->getEmail(), $user->getPassword());
    }
}
