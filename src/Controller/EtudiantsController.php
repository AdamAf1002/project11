<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantsController extends AbstractController
{
    #[Route('/etudiants', name: 'etud')]
    public function index(): Response
    {
        $tokens = array(
            '1' =>array(
                "username"=>"nom1",
                "gender"=>"male",
                "password"=>"test"
            ),
            "2" =>array(
                "username"=>"nom2",
                "gender"=>"female",
                "password"=>"test"
            )
        );
        if (isset($_COOKIE['token'])){
            if (isset($tokens[$_COOKIE['token']])){
                $nom = $tokens[$_COOKIE['token']]['username'];
                if ($tokens[$_COOKIE['token']]['gender'] == "male"){
                    $title = "Mr.";
                }
                else{$title = "Mde.";}
                return $this->render('etud.html.twig', [
                    'username' => $nom,
                    'title' => $title
                ]);
            }
            else{

                return $this->render('redirect.html.twig',[
                    'url'=>"/connexion"
                ]);            }
        }
        else{
            return $this->render('redirect.html.twig',[
                'url'=>"/connexion"
            ]);                    }


    }
}
