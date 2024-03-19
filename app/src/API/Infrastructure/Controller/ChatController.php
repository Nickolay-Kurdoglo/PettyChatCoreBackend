<?php

declare(strict_types=1);

namespace App\API\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController
{
    #[Route(path: '/api/v1/chats', methods: 'GET')]
    public function getAllChats(Request $request): Response
    {
        $chats = [
            [
                'id' => 1,
                'user' => 'Hey grow',
                'lastMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, quod?',
                'date' => 1709306332271,
            ],
            [
                'id' => 2,
                'user' => 'Courtney Henry',
                'lastMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, quod?',
                'date' => 1709306834271,
            ],
            [
                'id' => 3,
                'user' => 'Brooklyn Simmons',
                'lastMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, quod?',
                'date' => 1709316832271,
            ],
            [
                'id' => 4,
                'user' => 'Arlene McCoy',
                'lastMessage' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, quod?',
                'date' => 1709306842271,
            ]
        ];

        return new JsonResponse($chats);
    }
}
