<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        $users = array(
                'nom1' =>array(
                    "token"=>"1",
                    "gender"=>"male",
                    "password"=>"test"
                ),
                "nom2" =>array(
                    "token"=>"2",
                    "gender"=>"female",
                    "password"=>"test"
                ),
                "nom3" =>array(
                "token"=>"2",
                "gender"=>"female",
                "password"=>"test"
                )
        );
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->render('login.html.twig',[
                "username_error" => "",
                "password_error" => ""
            ]);
        } else {
            if (in_array($_POST['username'],$users)){
                if ($_POST['password'] == $users[$_POST['username']]['password']){
                    start_session();
                    $_SESSION['token']=$users[$_POST['username']]['token'];
                    return $this->render('redirect.html.twig',[
                        'url'=>"/"
                    ]);
                }else{
                    return $this->render('login.html.twig',[
                        "username_error" => "",
                        "password_error" => "le mot de passe est faux!"
                    ]);
                }
            }else{
                return $this->render('login.html.twig',[
                    "username_error" => " identifiant n'existe pas en bd",
                    "password_error" => ""

                ]);
            }
        }

    }
}
