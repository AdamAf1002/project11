<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Etudiant;

#[Route('/note')]
class NoteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_note_index', methods: ['GET'])]
    public function index(NoteRepository $noteRepository): Response
    {
        
        return $this->render('note/index.html.twig', [
            'notes' => $noteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_note_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NoteRepository $noteRepository): Response
    {
        $note = new Note();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
      
        if ($form->isSubmitted() && $form->isValid()) {
            $noteRepository->save($note, true);

            return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note/new.html.twig', [
            'note' => $note,
            'form' => $form,
        ]);
    }

    #[Route('/{anneeuniversitaire}', name: 'app_note_show', methods: ['GET'])]
    public function show(Note $note): Response
    {
        $etudiantRepository = $this->entityManager->getRepository(Etudiant::class);

        $etudiants = $etudiantRepository->createQueryBuilder('e')
            ->select("CONCAT(e.nom, ' ', e.prenom) AS nomComplet")
            ->getQuery()
            ->getResult();
        $etuds = [];
        foreach ($etudiants as $etudiant) {
            $nomComplet = $etudiant['nomComplet'];
            array_push($etuds,$nomComplet);
        }
        return $this->render('note/show.html.twig', [
            'note' => $note,
            "etuds"=>$etuds,
        ]);
    }

    #[Route('/{anneeuniversitaire}/edit', name: 'app_note_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Note $note, NoteRepository $noteRepository): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        $etudiantRepository = $this->entityManager->getRepository(Etudiant::class);

        $etudiants = $etudiantRepository->createQueryBuilder('e')
            ->select("CONCAT(e.nom, ' ', e.prenom) AS nomComplet")
            ->getQuery()
            ->getResult();
        $etuds = [];
        foreach ($etudiants as $etudiant) {
            $nomComplet = $etudiant['nomComplet'];
            array_push($etuds,$nomComplet);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $noteRepository->save($note, true);

            return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('note/edit.html.twig', [
            'note' => $note,
            'form' => $form,
            "etuds"=>$etuds,
        ]);
    }

    #[Route('/{anneeuniversitaire}', name: 'app_note_delete', methods: ['POST'])]
    public function delete(Request $request, Note $note, NoteRepository $noteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$note->getAnneeuniversitaire(), $request->request->get('_token'))) {
            $noteRepository->remove($note, true);
        }

        return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/consultationnotes', name: 'consultation_notes', methods: ['GET'])]
    public function consultationNotes(){
    
        return $this->renderForm('note/consultation_notes.html.twig', [
            
        ]);
    }
}
