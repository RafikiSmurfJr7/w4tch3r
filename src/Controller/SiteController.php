<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class SiteController extends AbstractController
{
    #[Route('/', name: 'app_site')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'The w4tch3r website',
            'path' => 'src/Controller/SiteController.php',
        ]);
    }
}
