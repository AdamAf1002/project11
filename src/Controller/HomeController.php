<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\FiliereRepository;
use App\Repository\GroupeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{    
    /**utlisateur courent 
    private User $curentuser;*/

    #[Route(path:['/','/home'], name: 'app_home',methods:['GET','POST'])]
    public function index(FiliereRepository $filiereRepository,UserRepository $userRepository,GroupeRepository $groupeRepository): Response
      
    {
       
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        $filieres=[];
        foreach ($filiereRepository->findAll() as $filiere) {
            array_push($filieres,$filiere->getNomfiliere());
        }

        $groupes=[];

        foreach ($groupeRepository->findAll() as $groupe) {
            array_push($groupes,$groupe->getNomgrp());
        }
        return $this->render('home/acceuil.html.twig', [
            'controller_name' => 'FiliereController'
            ,'filieres'=>$filieres
            ,'groupes'=>$groupes
            , 'username'=>$currentuser->getPrenom()

        ]);
    }

    
}
