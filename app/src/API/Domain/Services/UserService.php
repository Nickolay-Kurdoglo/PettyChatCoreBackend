<?php

declare(strict_types=1);

namespace App\API\Domain\Services;

use App\API\Domain\Entity\User;
use App\API\Domain\Repository\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository,
    ) {
    }

    public function addUser(User $user): void
    {
        $this->repository->put($user);
    }
}
