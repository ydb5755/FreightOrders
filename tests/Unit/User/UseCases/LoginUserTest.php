<?php

namespace Tests\Unit\User\UseCases;

use PHPUnit\Framework\TestCase;
use FreightQuote\User\User;
use FreightQuote\User\UseCases\LoginUser;
use FreightQuote\User\UseCases\LoginUserRequest;
use Tests\Fakes\User\FakeUserRepository;

class LoginUserTest extends TestCase
{
    public function test_login(): void
    {
        $email = 'test@test.com';
        $password = password_hash('testPassword', PASSWORD_DEFAULT);
        $user = new User($email, $password);
        $userRepo = new FakeUserRepository();
        $userRepo->save($user);
        $dto = new LoginUserRequest($email, 'testPassword');
        $useCase = new LoginUser($dto, $userRepo);
        $response = $useCase->execute();
        $this->assertTrue($response);
    }

    public function test_non_existing_user_login_fails(): void
    {
        $email = 'test@test.com';
        $password = 'testPassword';
        $dto = new LoginUserRequest($email, $password);
        $userRepo = new FakeUserRepository();
        $useCase = new LoginUser($dto, $userRepo);
        $response = $useCase->execute();
        $this->assertFalse($response);
    }

    public function test_wrong_password_fails(): void
    {
        $email = 'test@test.com';
        $password = 'testPassword';
        $user = new User($email, $password);
        $userRepo = new FakeUserRepository();
        $userRepo->save($user);
        $dto = new LoginUserRequest($email, 'wrongPassword');
        $useCase = new LoginUser($dto, $userRepo);
        $response = $useCase->execute();
        $this->assertFalse($response);
    }
}
