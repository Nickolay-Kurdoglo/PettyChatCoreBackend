<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Controller;

use App\API\Domain\Entity\User;
use App\API\Domain\Services\UserService;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SingUpController extends AbstractController
{
    #[Route(path: '/api/v1/auth/sign-up', methods: 'POST')]
    public function store(Request $request, ValidatorInterface $validator, UserService $service): Response
    {
        $data = $request->getPayload();

        $user = new User();
        $user->setUsername($data->get('name'));
        $user->setEmail($data->get('email'));
        $user->setPassword($data->get('password'));

        $errors = $validator->validate($user);
        if ($errors->count() > 0) {
            return new JsonResponse([
                'info' => 'Wrong data'
            ], 403);
        }

        $service->addUser($user);

        $cookie = Cookie::create(
            name: 'refresh_token',
            value: $user->getRefreshToken(),
            expire: Carbon::now()->addMonth(),
            secure: true,
            sameSite: Cookie::SAMESITE_NONE,
            partitioned: true
        );

        $res = new JsonResponse();
        $res->headers->setCookie($cookie);
        $res->setData(['token' => $user->getAccessToken()]);

        return $res;
    }
}
