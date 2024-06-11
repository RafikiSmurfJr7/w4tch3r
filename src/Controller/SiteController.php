<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[IsGranted('ROLE_USER')]
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
