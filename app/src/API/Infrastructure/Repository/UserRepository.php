<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Repository;

use App\API\Domain\Entity\User;
use App\API\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {
    }

    public function findOne()
    {
        // TODO: Implement findOne() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function put(User $entity): User|false
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }
}
