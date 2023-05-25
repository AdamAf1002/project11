<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Repository\FiliereRepository;
use App\Repository\GroupeRepository;
    use App\Entity\Etudiant;

class MaquetteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/maquette', name: 'app_maquette')]
    public function index(FiliereRepository $filiereRepository,UserRepository $userRepository,GroupeRepository $groupeRepository): Response
    {        if(!$this->getUser())
        return $this->redirectToRoute('security.login');
        else{
            $currentuser=null;
        foreach ($userRepository->findAll() as $key => $value) {
            if($value->getEmail()==$this->getUser()->getUserIdentifier()){
                $currentuser=$value;
            }
        }
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
        return $this->render('maquette/index.html.twig', [
            'controller_name' => 'MaquetteController',
            'username'=>$currentuser->getPrenom(),
            "etuds"=>$etuds,
        ]);
        }

    }
}
