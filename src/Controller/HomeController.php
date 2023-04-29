<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
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
        if (isset($_SESSION['token'])){
            if (isset($tokens[$_SESSION['token']])){
                $nom = $tokens[$_SESSION['token']]['username'];
                if ($tokens[$_SESSION['token']]['gender'] == "male"){
                    $title = "Mr.";
                }
                else{$title = "Mde.";}
                return $this->render('base.html.twig', [
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
