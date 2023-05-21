<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class ModifierController extends AbstractController
{
    #[Route('/modifier', name: 'app_modifier')]
    public function index(): Response
    {
        return $this->render('modifier/index.html.twig', [
            'controller_name' => 'ModifierController',
        ]);
    }
}
