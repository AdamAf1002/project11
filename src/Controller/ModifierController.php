<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Etudiant;


class ModifierController extends AbstractController
{
    private $userRepository;
    private $entityManager;
    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/modifier', name: 'app_modifier')]
    public function index(UserRepository $userRepository): Response
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
        if (!$this->getUser()) {
            return $this->redirectToRoute('security.login');
        }

        return $this->render('modifier/index.html.twig', [
            'controller_name' => 'ModifierController',
            "etuds"=>$etuds,
        ]);
    }
    #[Route('/modifier/post', name: 'app_modifier_action', methods: ['POST'])]
    public function modifierAction(Request $request): Response
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://hcaptcha.com/siteverify', [
            'body' => [
                'secret' => '0x739da3512C5220a911959cd57aF390489DF53C26',
                'response' => $request->request->get('h-captcha-response')
            ]
        ]);
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
        $responseData = $response->toArray();
        if (!$responseData['success']) {
            return $this->render('modifier/error.html.twig', [
                'error' => 'captcha incorrecte!',
                "etuds"=>$etuds,
            ]);
        }
    

        $email = $request->request->get('email');
        $newPassword = $request->request->get('new_password');
        $lastPassword = $request->request->get('last_password');
        
        // Get the user based on the email
        $user = $this->userRepository->findOneBy(['email' => $email]);
        
        if ($user) {
            // Check if the last password matches
            if (password_verify($lastPassword, $user->getPassword())) {
                // Set the new password
                $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                
                // Save the changes to the database
                $this->entityManager->flush();
                
                return $this->render('modifier/success.html.twig');
            } else {
                return $this->render('modifier/error.html.twig', [
                    'error' => 'nouveau mot de passe incorrecte',
                    "etuds"=>$etuds,
                ]);
            }
        } else {
            return $this->render('modifier/error.html.twig', [
                'error' => 'Utilistateur non reconnue',
                "etuds"=>$etuds,
            ]);
        }
    }
}
