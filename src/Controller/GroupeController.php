<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    #[Route('/groupe{id}', name: 'app_groupe')]
    public function index(): Response
    {
        return $this->render('groupe/groupe.html.twig', [
            'controller_name' => 'GroupeController',
        ]);
    }
}
