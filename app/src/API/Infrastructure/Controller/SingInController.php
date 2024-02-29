<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Controller;

use App\API\Domain\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SingInController extends AbstractController
{
    #[Route(path: '/api/sing-in', methods: 'POST')]
    public function store(Request $request, ValidatorInterface $validator, UserService $service): Response
    {
        $data = $request->getPayload();

        $user = $service->getByEmail($data->get('email'));
        if (!$user){
            return new JsonResponse(['status' => 'Not Found']);
        }

        $isValid =password_verify($data->get('password'),$user->getPassword());

        return new JsonResponse(['valid'=>$isValid]);
    }
}