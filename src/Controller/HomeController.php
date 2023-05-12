<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\User;
use App\Repository\EtudiantRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{    
    /**utlisateur courent 
    private User $curentuser;*/

    #[Route(path:['/','/home'], name: 'app_home',methods:['GET','POST'])]
    public function index(): Response
      
    {
       
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        
                
        return $this->render('home/acceuil.html.twig', [
            'controller_name' => 'FiliereController'
        ]);
    }

    
}
