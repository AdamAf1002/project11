<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
#[Route('/matière')]
class MatiereController extends AbstractController
{
    #[Route('/', name: 'app_matiere_index', methods: ['GET'])]
    public function index(MatiereRepository $matiereRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->render('matiere/index.html.twig', [
            'matieres' => $matiereRepository->findAll(),
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/new', name: 'app_matiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MatiereRepository $matiereRepository,UserRepository $userRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }

        $matiere = new Matiere();
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matiereRepository->save($matiere, true);

            return $this->redirectToRoute('app_matiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/{codemat}', name: 'app_matiere_show', methods: ['GET'])]
    public function show(Matiere $matiere): Response
    {

        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
        ]);
    }

    #[Route('/{codemat}/edit', name: 'app_matiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Matiere $matiere, MatiereRepository $matiereRepository,UserRepository $userRepository): Response
    {
        $form = $this->createForm(MatiereType::class, $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matiereRepository->save($matiere, true);
            
            return $this->redirectToRoute('app_matiere_index', [], Response::HTTP_SEE_OTHER);
        }
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

         $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
        return $this->renderForm('matiere/edit.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
    }

    #[Route('/{codemat}', name: 'app_matiere_delete', methods: ['POST'])]
    public function delete(Request $request, Matiere $matiere, MatiereRepository $matiereRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$matiere->getCodemat(), $request->request->get('_token'))) {
            $matiereRepository->remove($matiere, true);
        }

        return $this->redirectToRoute('app_matiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
