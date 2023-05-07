<?php

namespace App\Controller;

use App\Entity\Bloc;
use App\Form\Bloc1Type;
use App\Repository\BlocRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
#[Route('/bloc')]
class BlocController extends AbstractController
{
    #[Route('/', name: 'app_bloc_index', methods: ['GET'])]
    public function index(BlocRepository $blocRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->render('bloc/index.html.twig', [
            'blocs' => $blocRepository->findAll(),
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/new', name: 'app_bloc_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlocRepository $blocRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        $bloc = new Bloc();
        $form = $this->createForm(Bloc1Type::class, $bloc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blocRepository->save($bloc, true);

            return $this->redirectToRoute('app_bloc_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('bloc/new.html.twig', [
            'bloc' => $bloc,
            'form' => $form,
            'username'=>$currentuser->getPrenom()

        ]);
    }


    #[Route('/{codebloc}/edit', name: 'app_bloc_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bloc $bloc, BlocRepository $blocRepository,UserRepository $userRepository): Response
    {
        $form = $this->createForm(Bloc1Type::class, $bloc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blocRepository->save($bloc, true);

            return $this->redirectToRoute('app_bloc_index', [], Response::HTTP_SEE_OTHER);
        }
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        return $this->renderForm('bloc/edit.html.twig', [
            'bloc' => $bloc,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
    }
    #[Route('/{codebloc}/delete', name: 'app_bloc_delete_', methods: ['GET', 'POST'])]
    public function delete_(Request $request, Bloc $bloc, BlocRepository $blocRepository,UserRepository $userRepository): Response
    {

        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        return $this->renderForm('bloc/delete.html.twig', [
            'bloc' => $bloc,
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/{codebloc}', name: 'app_bloc_delete', methods: ['POST'])]
    public function delete(Request $request, Bloc $bloc, BlocRepository $blocRepository,UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bloc->getCodebloc(), $request->request->get('_token'))) {
            $blocRepository->remove($bloc, true);
            
        }

        return $this->redirectToRoute('app_bloc_index', [], Response::HTTP_SEE_OTHER);
        
    }
}
