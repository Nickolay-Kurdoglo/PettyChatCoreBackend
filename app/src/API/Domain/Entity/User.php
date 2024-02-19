<?php

declare(strict_types=1);

namespace App\API\Domain\Entity;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class User
{
    #[NotBlank]
    #[Length(min: 2, max: 50)]
    private string $username;
    #[NotBlank]
    #[Email]
    #[Length(min: 2, max: 50)]
    private string $email;
    #[NotBlank]
    #[Length(min: 8, max: 72)]
    private string $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
