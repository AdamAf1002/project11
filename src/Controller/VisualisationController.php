<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\MatiereRepository;
use App\Repository\UniteRepository;
use App\Repository\BlocRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisualisationController extends AbstractController
{    
    /**utlisateur courent 
    private User $curentuser;*/

    #[Route(path:['/visualisation'], name: 'visualisation',methods:['GET','POST'])]
    public function index(BlocRepository $blocRepository,UniteRepository $uniteRepository,MatiereRepository $matiereRepository,UserRepository $userRepository): Response
      
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
        return $this->render('visualisation/index.html.twig', [
            'unites' => $uniteRepository->findAll(),
            'username'=>$currentuser->getPrenom(),
            'matieres' => $matiereRepository->findAll(),
            'blocs' => $blocRepository->findAll()
        ]);
    }

    
}
