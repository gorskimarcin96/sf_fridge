<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreetingsController extends AbstractController
{
    #[Route('/greetings', name: 'app_greetings')]
    public function index(): Response
    {
        return new JsonResponse();
    }
}
