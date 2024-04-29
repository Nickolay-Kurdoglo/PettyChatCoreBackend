<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Repository;

use App\API\Domain\Entity\User;
use App\API\Domain\Repository\UserRepositoryInterface;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
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

        $now = Carbon::now();
        $accessToken = JWT::encode([
            'id'    => $entity->getId(),
            'sub'   => $entity->getUsername(),
            'email' => $entity->getEmail(),
            'iat'   => $now->getTimestamp(),
            'exp'   => (clone $now)->addHour()->getTimestamp(),
        ],
            (string) getenv('JWT_SECRET'),
            'HS256'
        );

        $refreshToken = JWT::encode([
            'id'    => $entity->getId(),
            'sub'   => $entity->getUsername(),
            'email' => $entity->getEmail(),
            'iat'   => $now->getTimestamp(),
            'exp'   => (clone $now)->addMonths(2)->getTimestamp(),
        ],
            (string) getenv('JWT_SECRET'),
            'HS256'
        );

        $entity->setAccessToken($accessToken);
        $entity->setRefreshToken($refreshToken);
        $entity->setCreatedAt($now);

        $this->entityManager->flush();

        return $entity;
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }
}
