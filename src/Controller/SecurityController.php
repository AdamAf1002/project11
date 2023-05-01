<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security.login',methods:['GET','POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser())
        return $this->redirectToRoute('home');

        $lastUsername=$authenticationUtils->getLastUsername();
        $error=$authenticationUtils->getLastAuthenticationError();
        return $this->render('login/login.html.twig', [
            'controller_name' => 'SecurityController', 
            'last_username'=>$lastUsername,
            'error'=>$error
        ]);
    }
    #[Route('/logout', name: 'security.logout')]
    public function logout(){
        

    }
}
