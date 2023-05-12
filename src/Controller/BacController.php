<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Form\BacType;
use App\Repository\BacRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bac')]
class BacController extends AbstractController
{
    #[Route('/', name: 'app_bac_index', methods: ['GET'])]
    public function index(BacRepository $bacRepository): Response
    {
        return $this->render('bac/index.html.twig', [
            'bacs' => $bacRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bac_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BacRepository $bacRepository): Response
    {
        $bac = new Bac();
        $form = $this->createForm(BacType::class, $bac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bacRepository->save($bac, true);

            return $this->redirectToRoute('app_bac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bac/new.html.twig', [
            'bac' => $bac,
            'form' => $form,
        ]);
    }

    #[Route('/{idbac}', name: 'app_bac_show', methods: ['GET'])]
    public function show(Bac $bac): Response
    {
        return $this->render('bac/show.html.twig', [
            'bac' => $bac,
        ]);
    }

    #[Route('/{idbac}/edit', name: 'app_bac_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bac $bac, BacRepository $bacRepository): Response
    {
        $form = $this->createForm(BacType::class, $bac);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bacRepository->save($bac, true);

            return $this->redirectToRoute('app_bac_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bac/edit.html.twig', [
            'bac' => $bac,
            'form' => $form,
        ]);
    }

    #[Route('/{idbac}', name: 'app_bac_delete', methods: ['POST'])]
    public function delete(Request $request, Bac $bac, BacRepository $bacRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bac->getIdbac(), $request->request->get('_token'))) {
            $bacRepository->remove($bac, true);
        }

        return $this->redirectToRoute('app_bac_index', [], Response::HTTP_SEE_OTHER);
    }
}
