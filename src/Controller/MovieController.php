<?php

namespace App\Controller;

use App\Service\TMDBMovies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(TMDBMovies $movies): JsonResponse
    {
        return $this->json($movies->getMovies());

    }
}
