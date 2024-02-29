<?php

declare(strict_types=1);

namespace App\API\Domain\Services;

use App\API\Domain\Entity\User;
use App\API\Domain\Repository\UserRepositoryInterface;
use Firebase\JWT\JWT;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function add(User $user): void
    {
        $token = JWT::encode([
            'username' => $user->getUsername()
        ],
            'some_key',
            'HS256'
        );

        $user->setToken($token);

        $this->repository->put($user);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->repository->getByEmail($email);
    }
}
