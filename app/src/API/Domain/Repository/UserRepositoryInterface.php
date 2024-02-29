<?php

namespace App\API\Domain\Repository;

use App\API\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findOne();

    public function all();

    public function put(User $entity): User|false;

    public function remove();
}
