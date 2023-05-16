<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\UserRepository;
use App\Repository\GroupeRepository;
use App\Repository\FiliereRepository;
use App\Repository\EtudiantRepository;
use function PHPUnit\Framework\isNull;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/etudiant')]
class EtudiantController extends AbstractController
{
    #[Route('/', name: 'app_etudiant_home', methods: ['GET'])]
    public function index(Request $request,UserRepository $userRepository): Response
      
    {
        if(!$request->getSession()->get("user"))
        return $this->redirectToRoute('security.login');   
    
        return $this->render('etudiant/home.html.twig', [
            'controller_name' => 'EtudiantController'
        ]);
    }

    #[Route(path:['/filiere'], name: 'app_etudiant_filiere', methods: ['GET'])]
    public function etudiantf(Request $request,FiliereRepository $filiereRepository,GroupeRepository $groupeRepository): Response
      
    {
          if(!$request->getSession()->get("user"))
         return $this->redirectToRoute('security.login');

         $nomfiliere = $request->query->get('nomfiliere');
         #dd($nomfiliere);
    if($nomfiliere){
        $groupes=[];
        foreach ($groupeRepository->findAll() as $key => $groupe) {
               
                 if($this->verif_groupe($nomfiliere,$groupe->getNomgrp()))
                 array_push($groupes,$groupe);
        }
        
            return $this->render('etudiant/groupe.html.twig', [
                'controller_name' => 'EtudiantController'
                ,'groupes'=>$groupes
                
    
            ]);

    }
    
        return $this->render('etudiant/filiere.html.twig', [
            'controller_name' => 'EtudiantController'
            ,'filieres'=>$filiereRepository->findAll()

        ]);
    }

  
    #[Route(path:['/groupe'], name: 'app_etudiant_etudiant', methods: ['GET','POST'])]
    public function view(Request $request,EtudiantRepository $etudiantRepository,PaginatorInterface $paginator): Response
      
    {
        if(!$request->getSession()->get("user"))
        return $this->redirectToRoute('security.login');

        $codegroupe = $request->query->get('codegroupe');
    $etud=[];
    $nomgroupe=null;
    foreach ($etudiantRepository->findAll() as $key => $etudiant) {
           
             if($etudiant->getGroupe()->getCodegrp()==$codegroupe){
                array_push($etud,$etudiant);
                if($etudiant&&$etudiant->getGroupe()->getNomgrp()!=null)
                   $nomgroupe=$etudiant->getGroupe()->getNomgrp();
              }
    } 
    usort($etud,function($a,$b){
        if($a->getNom()==$b->getNom())
          return 0 ;
          else
          return $a->getNom()>$b->getNom()?1:-1;
     });
      
     #$nomgroupe=array_pop($etud)->getGroupe()->getNomgrp();
     $nomfiliere = $this->nomfiliere($nomgroupe);
      $etudiants=$paginator->paginate($etud,
      $request->query->getInt('page',1),5);
         #dd($etudiants);
         return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController'
            ,'etudiants'=>$etudiants,
            'nomgroupe'=>$nomgroupe,
           'nomfiliere'=>$nomfiliere

        ]);
    }

    #[Route('/etudiants', name: 'app_etudiant_index', methods: ['GET', 'POST'])]
    public function test(EtudiantRepository $etudiantRepository): Response
    {
        
        

        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiantRepository->findAll()
        ]);
    }

    #[Route('/newetudiantt', name: 'app_etudiant_newetudiant', methods: ['GET', 'POST'])]
    public function newetudiant(EtudiantRepository $etudiantRepository): Response
    {

        return $this->render('etudiant/newetudiant.html.twig', [
        ]);
    }

    #[Route('/new', name: 'app_etudiant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtudiantRepository $etudiantRepository): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiantRepository->save($etudiant, true);

            return $this->redirectToRoute('app_etudiant_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);
    }

    #[Route('/{numetd}', name: 'app_etudiant_show', methods: ['GET'])]
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    #[Route('/{numetd}/edit', name: 'app_etudiant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etudiant $etudiant, EtudiantRepository $etudiantRepository): Response
    {
        if(!$this->getUser())
        return $this->redirectToRoute('security.login'); 
        $codegroupe = $request->query->get('codegroupe');  
        
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiantRepository->save($etudiant, true);

            return $this->redirectToRoute('app_etudiant_etudiant', [
                'codegroupe'=>$codegroupe
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
            'codegroupe'=>$codegroupe
        ]);
    }

    #[Route('/{numetd}', name: 'app_etudiant_delete', methods: ['POST'])]
    public function delete(Request $request, Etudiant $etudiant, EtudiantRepository $etudiantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etudiant->getNumetd(), $request->request->get('_token'))) {
            $etudiantRepository->remove($etudiant, true);
        }

        return $this->redirectToRoute('app_etudiant_index', [], Response::HTTP_SEE_OTHER);
    }

/**
 * verifie si un groupe appartient à une filière
 * vous pouvez ajouter  l'ensemble des groupes de chaque filière 
 * en miniscule ainsi que les filières
 *
 * @param string $filiere
 * @param string $groupe
 * @return boolean
 */
function verif_groupe(string $filiere, string $groupe) :bool{
    $groupes_filiere = array();
    switch (strtolower(trim($filiere))) {
        case "licence 2 informatique":
            $groupes_filiere = array("l2-infor-grp-1","l2-infor-grp-2","l2-info-grp-1","l2-info-grp-2");
            break;
        case "licence 3 informatique":
            $groupes_filiere = array("l3-infor-grp-1","l3-infor-grp-2","l3-info-grp-1","l3-info-grp-2");
            break;
        case "licence 1 informatique":
                $groupes_filiere = array("l1-infor-grp-1","l1-infor-grp-2","l1-info-grp-1","l1-info-grp-2");
            break;
        // Ajouter d'autres cas pour chaque filière
        default:
            return false;
    }
    if (in_array(strtolower(trim($groupe)), $groupes_filiere)) {
        return true;
    } else {
        return false;
    }
}
function nomfiliere( $codegroupe) :string{
   
   $codegroupe=strtolower(trim($codegroupe));
            if (in_array($codegroupe,array("l2-infor-grp-1","l2-infor-grp-2","l2-info-grp-1","l2-info-grp-2")))
              return "Licence 2 informatique";
             else if (in_array($codegroupe ,array("l3-infor-grp-1","l3-infor-grp-2","l3-info-grp-1","l3-info-grp-2")))
              return "Licence 3 informatique";
              else if (in_array($codegroupe ,array("l1-infor-grp-1","l1-infor-grp-2","l1-info-grp-1","l1-info-grp-2")))
              return "Licence 1 informatique";
             else
                 return "";
            
    }


    
}



