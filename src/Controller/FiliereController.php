<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/filiere')]
class FiliereController extends AbstractController
{
    #[Route('/', name: 'app_filiere_index', methods: ['GET'])]
    public function index(Request $request,FiliereRepository $filiereRepository,PaginatorInterface $paginator): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        $a=[];
        foreach ($filiereRepository->findAll() as $key => $value) {
            array_push($a,$value->getBlocs()->toArray());
        }
       dd($a);
        $currentUser = $this->getUser();
        $blocQuery = $filiereRepository->createQueryBuilder('b')
        ->orderBy('b.codefiliere', 'ASC')
        ->getQuery();
    $nombres = array();
    $i = 0;
    $total = $filiereRepository->count([]);
    $parpage = 6;
   
    $nombres = range(1,ceil($total / $parpage));
    $filieres = $paginator->paginate(
            $blocQuery,
            $request->query->getInt('page', 1),
            6 
        );
        return $this->render('filiere/index.html.twig', [
            'filieres' => $filieres,
            'nombres' =>$nombres,
            'page' => $request->query->getInt('page', 1),
        ]);
    }

    #[Route('/new', name: 'app_filiere_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FiliereRepository $filiereRepository): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filiereRepository->save($filiere, true);

            return $this->redirectToRoute('app_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filiere/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{codefiliere}', name: 'app_filiere_show', methods: ['GET'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{codefiliere}/edit', name: 'app_filiere_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filiere $filiere, FiliereRepository $filiereRepository): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filiereRepository->save($filiere, true);

            return $this->redirectToRoute('app_filiere_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('filiere/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{codefiliere}', name: 'app_filiere_delete', methods: ['POST'])]
    public function delete(Request $request, Filiere $filiere, FiliereRepository $filiereRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getCodefiliere(), $request->request->get('_token'))) {
            $filiereRepository->remove($filiere, true);
        }

        return $this->redirectToRoute('app_filiere_index', [], Response::HTTP_SEE_OTHER);
    }
}
