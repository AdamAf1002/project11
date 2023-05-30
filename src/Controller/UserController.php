<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Form\UserType;
use App\Entity\User;
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user', methods: ['GET', 'POST'])]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        if ($request->getMethod() === 'POST') {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        $roles = $currentuser->getRoles();
        if (!in_array("ROLE_ADMIN",$roles)){
            return $this->renderForm('user/error.html.twig', [
                'errors'=>["Vous n'êtes pas un ADMIN "],
            ]);
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $user->setRoles(['ROLE_USER']);
            //return 'sdqsd';
            return $this->redirectToRoute('app_user', [], Response::HTTP_SEE_OTHER);
        }
        $errors = $form->getErrors();
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }
        
        return $this->renderForm('user/error.html.twig', [
            'errors' => $errorMessages,
        ]);
    }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        return $this->renderForm('user/index.html.twig', [
            'user'=>$user,
            'form' => $form,
        ]);
    }

}
