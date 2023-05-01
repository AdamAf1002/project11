<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{    
    /**utlisateur courent 
    private User $curentuser;*/

    #[Route('/', name: 'home')]
    public function index(UserRepository $repository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($repository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
 

        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController'
            ,'username'=>$currentuser->getPrenom()
    ]);
    }

    
}
