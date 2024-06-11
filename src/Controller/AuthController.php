<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/auth/register', name: 'auth_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository): JsonResponse
    {
        $authData = array();


        $authData["username"] = $request->getPayload()->get("username");
        $authData["password"] = $request->getPayload()->get("password");

        if (in_array(null, $authData)) {
            return $this->json(
                [
                    'message' => 'You cannot leave blank fields'
                ],
                status: Response::HTTP_BAD_REQUEST
            );
        } else if ($userRepository->findOneBy(['username' => $authData["username"]])) {
            return $this->json(
                [
                    'message' => 'The username ' . $authData["username"] . ' has already been inserted.'
                ],
                status: Response::HTTP_BAD_REQUEST
            );
        }

        $user = new User();

        $user->setUsername($authData["username"]);
        $user->setPassword($passwordHasher->hashPassword($user, $authData["password"]));

        $userRepository->save($user);

        return $this->json([
            'message' => "User " . $user->getUsername() . " saved",
            'data' => $user
        ]);
    }
}
