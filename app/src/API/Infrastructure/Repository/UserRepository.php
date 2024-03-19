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
            'sub'   => $entity->getId(),
            'email' => $entity->getEmail(),
            'exp'   => $now->addHour()->getTimestamp(),
            'iat'   => $now->getTimestamp(),
        ],
            (string) getenv('JWT_SECRET'),
            'HS256'
        );

        $refreshToken = JWT::encode([
            'sub'   => $entity->getId(),
            'email' => $entity->getEmail(),
            'exp'   => $now->addMonths(2)->getTimestamp(),
            'iat'   => $now->getTimestamp(),
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
