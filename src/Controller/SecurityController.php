<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'security.login',methods:['GET','POST'])]
    public function login(Request $request,EtudiantRepository $etudiantRepository,UserRepository $userRepository,AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser()){
            $currentuser=null;
            foreach ($userRepository->findAll() as $key => $value) {
                if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                    $currentuser=$value;
                   # dd($currentuser);
                }
            }
            $etudiants=[];
            foreach ($etudiantRepository->findAll() as $key => $etudiant) {
               $name=$etudiant->getNom()." ".$etudiant->getPrenom();
               array_push($etudiants,$name);
            }

            $session=$request->getSession();
        $session->set("user",$currentuser);
        $session->set("etudiants",$etudiants);

        return $this->redirectToRoute('home');
        }

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
