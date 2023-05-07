<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\FiliereRepository;
use App\Repository\GroupeRepository;
class MaquetteController extends AbstractController
{
    #[Route('/maquette', name: 'app_maquette')]
    public function index(FiliereRepository $filiereRepository,UserRepository $userRepository,GroupeRepository $groupeRepository): Response
    {        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        else{
            $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        return $this->render('maquette/index.html.twig', [
            'controller_name' => 'MaquetteController',
            'username'=>$currentuser->getPrenom()
        ]);
        }

    }
}
