<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Repository;

use App\API\Domain\Entity\User;
use App\API\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function findOne()
    {
        // TODO: Implement findOne() method.
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function getByEmail(string $email): ?User
    {
        return $this->findOneBy(['email'=>$email]);
    }

    public function put(User $entity): User|false
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }
}
