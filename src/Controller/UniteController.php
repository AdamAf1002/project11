<?php

namespace App\Controller;

use App\Entity\Unite;
use App\Form\UniteType;
use App\Repository\UniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
#[Route('/unité')]
class UniteController extends AbstractController
{
    #[Route('/', name: 'app_unite_index', methods: ['GET'])]
    public function index(UniteRepository $uniteRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->render('unite/index.html.twig', [
            'unites' => $uniteRepository->findAll(),
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/new', name: 'app_unite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UniteRepository $uniteRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        $unite = new Unite();
        $form = $this->createForm(UniteType::class, $unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uniteRepository->save($unite, true);

            return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
        }
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->renderForm('unite/new.html.twig', [
            'unite' => $unite,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
    }
    #[Route('/{codeunite}/edit', name: 'app_unite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Unite $unite, UniteRepository $uniteRepository,UserRepository $userRepository): Response
    {
        $form = $this->createForm(UniteType::class, $unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uniteRepository->save($unite, true);

            return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
        }
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->renderForm('unite/edit.html.twig', [
            'unite' => $unite,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/{codeunite}', name: 'app_unite_delete', methods: ['POST'])]
    public function delete(Request $request, Unite $unite, UniteRepository $uniteRepository,UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unite->getCodeunite(), $request->request->get('_token'))) {
            $uniteRepository->remove($unite, true);
        }

        return $this->redirectToRoute('app_unite_index', [], Response::HTTP_SEE_OTHER);
    }
}
