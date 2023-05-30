<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Entity\Element;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/matière')]
class MatiereController extends AbstractController
{


    private $entityManager;
    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    #[Route('/', name: 'app_matiere_index', methods: ['GET'])]
    public function index(Request $request,MatiereRepository $matiereRepository,UserRepository $userRepository,PaginatorInterface $paginator): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login');

        $currentUser = $this->getUser();
        $blocQuery = $matiereRepository->createQueryBuilder('b')
        ->orderBy('b.codemat', 'ASC')
        ->getQuery();
    $nombres = array();
    $i = 0;
    $total = $matiereRepository->count([]);
    $parpage = 6;

    $nombres = range(1,ceil($total / $parpage));
        $matieres = $paginator->paginate(
            $blocQuery,
            $request->query->getInt('page', 1),
            6 
        );

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
            'nombres' =>$nombres,
            'page' => $request->query->getInt('page', 1),
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
            $element=new Element();
            if(empty($this->entityManager->getRepository(Element::class)->findOneBy(["codeelt"=>$form->getData()->getCodemat()]))){
            $element->setCodeelt($form->getData()->getCodemat());
            $this->entityManager->persist($element);
            $this->entityManager->flush();
            $matiere->setElement($element);
            $matiereRepository->save($matiere, true);
          
            return $this->redirectToRoute('app_matiere_index', [], Response::HTTP_SEE_OTHER);
           

            
        }
        else
        return $this->renderForm('matiere/new.html.twig', [
            'matiere' => $matiere,
            'form' => $form,
            'username'=>$currentuser->getPrenom()
        ]);
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
