<?php

namespace App\Controller;

use App\Service\BoredApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BoredController extends AbstractController
{
    #[Route('/bored', name: 'boredapi')]
    public function getActivity(BoredApiClient $client): Response
    {
        return new JsonResponse($client->getData(), 200);
    }
}
