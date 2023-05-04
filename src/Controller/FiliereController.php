<?php

namespace App\Controller;

use App\Repository\FiliereRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route(path:['/filieres','/filiere/{nomfiliere}'], name: 'app_filiere')]
    public function index($nomfiliere,FiliereRepository $filiereRepository,UserRepository $userRepository): Response
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

        return $this->render('etudiant/filiere.html.twig', [
            'controller_name' => 'FiliereController'
            ,'filieres'=>$filieres
            , 'username'=>$currentuser->getPrenom()

        ]);
    }
}
