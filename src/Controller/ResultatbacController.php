<?php

namespace App\Controller;

use App\Entity\Resultatbac;
use App\Form\ResultatbacType;
use App\Repository\ResultatbacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/resultatbac')]
class ResultatbacController extends AbstractController
{
    #[Route('/', name: 'app_resultatbac_index', methods: ['GET'])]
    public function index(ResultatbacRepository $resultatbacRepository): Response
    {  
           ($resultatbacRepository->findAll());
        return $this->render('resultatbac/index.html.twig', [
            'resultatbacs' => $resultatbacRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resultatbac_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ResultatbacRepository $resultatbacRepository): Response
    {
        $resultatbac = new Resultatbac();
        $form = $this->createForm(ResultatbacType::class, $resultatbac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultatbacRepository->save($resultatbac, true);

            return $this->redirectToRoute('app_resultatbac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resultatbac/new.html.twig', [
            'resultatbac' => $resultatbac,
            'form' => $form,
        ]);
    }

    #[Route('/{bac}/{etudiant}', name: 'app_resultatbac_show', methods: ['GET'])]
    public function show(Resultatbac $resultatbac,$bac,$etudiant): Response
    {
        #dd($resultatbac);
        return $this->render('resultatbac/show.html.twig', [
            'resultatbac' => $resultatbac
        ]);
    }

    #[Route('/{bac}/{etudiant}/edit', name: 'app_resultatbac_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resultatbac $resultatbac, ResultatbacRepository $resultatbacRepository): Response
    {
        $form = $this->createForm(ResultatbacType::class, $resultatbac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resultatbacRepository->save($resultatbac, true);

            return $this->redirectToRoute('app_resultatbac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resultatbac/edit.html.twig', [
            'resultatbac' => $resultatbac,
            'form' => $form,
        ]);
    }

    #[Route('/{bac}/{etudiant}', name: 'app_resultatbac_delete', methods: ['POST'])]
    public function delete(Request $request, Resultatbac $resultatbac, ResultatbacRepository $resultatbacRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resultatbac->getBac()->getIdbac().$resultatbac->getEtudiant()->getNumetd(), $request->request->get('_token'))) {
            $resultatbacRepository->remove($resultatbac, true);
        }

        return $this->redirectToRoute('app_resultatbac_index', [], Response::HTTP_SEE_OTHER);
    }
}
