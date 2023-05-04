<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route(path:['/etudiants','/etudiants/groupe={idgroupe}'], name: 'app_etudiant')]
    public function index($idgroupe,UserRepository $repository,EtudiantRepository $etudiantRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login'); 

         $currentuser=null;
        foreach ($repository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        if($idgroupe){
            $etudiants=[];
          foreach ($etudiantRepository->findAll() as $key => $etudiant) {
            if($idgroupe==$etudiant->getGroupe()->getCodegrp()){
               array_push($etudiants,[$etudiant->getNumetd(),$etudiant->getNom(),$etudiant->getPrenom(),$etudiant->getSexe(),$etudiant->getEmail()]);
            }
          }
            
          return $this->render('etudiant/etudiant.html.twig', [
            'controller_name' => 'EtudiantController'
            ,'username'=>$currentuser->getPrenom()
            ,'etudiants'=>$etudiants
        ]);
        }
        return $this->render('etudiant/etudiant.html.twig', [
            'controller_name' => 'EtudiantController'
            ,'username'=>$currentuser->getPrenom()
        ]);
    }
}
