<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{     
    private User $curentuser;

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

        $this->curentuser = $this->getUser();

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController'
        ,'username'=>$this->curentuser->getPrenom()
    ]);
    }
}
