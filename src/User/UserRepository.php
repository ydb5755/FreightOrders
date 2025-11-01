<?php

namespace FreightQuote\User;

interface UserRepository
{
    public function findByEmail(string $email): ?User;
    public function save(User $user): User;
}
