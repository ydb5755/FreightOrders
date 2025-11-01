<?php

namespace FreightQuote\User\UseCases;

class LoginUserRequest
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}
