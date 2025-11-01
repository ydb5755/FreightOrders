<?php

namespace FreightQuote\User\UseCases;

use FreightQuote\User\UserRepository;

class LoginUser
{
    public function __construct(
        private LoginUserRequest $dto,
        private UserRepository $userRepo,
    ) {}

    public function execute(): bool
    {
        $user = $this->userRepo->findByEmail($this->dto->email);
        if (!$user) {
            return false;
        }
        if (!password_verify($this->dto->password, $user->getPassword())) {
            return false;
        }

        return true;
    }
}
