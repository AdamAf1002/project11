<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImportController extends AbstractController
{
    private $entityManager;
    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    #[Route('/import', name: 'etudiant_import')]
    public function index(Request $request,EtudiantRepository $etudiantRepository): Response
    {


        $form = $this->createFormBuilder()
        ->add('csv_file', FileType::class)
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $csvFile = $form->get('csv_file')->getData();
        // Traiter le fichier CSV et renvoyer les données
        // ...
        $file = fopen($csvFile->getPathname(), 'r');
        $csvData = [];

        // Lire la première ligne comme entête
        $headers = fgetcsv($file);

        while (($data = fgetcsv($file)) !== false) {
            $rowData = [];
            foreach ($headers as $index => $header) {
                $rowData[$header] = $data[$index] ?? null;
            }
            $csvData[] = $rowData;
        }

        fclose($file);

        // suppression du contenu de la table personne
        $query = $this->entityManager->createQuery('DELETE FROM ' . Etudiant::class);
        $query->execute();

        // Insertion
        foreach ($csvData as $record) {
            $etudiant = new Etudiant();

            $etudiant->setNumetd($record['Cod.etu.']);
            $etudiant->setPrenom($record['Prenom']);
            $etudiant->setNom($record['nomUsu.']);
            $etudiant->setSexe($record['sexe']);
            $etudiant->setSexe($record['sexe']);

            
            #$date_string = $record['date nai.'];
            #dd($date_string);
            /*$date_format = 'dd/mm/YY';
            $date1 = DateTimeImmutable::createFromFormat($date_format, $date_string);*/
            $etudiant->setDatnaiss(new DateTimeImmutable());
              $etudiant->setVillnaiss($record['vil.nai.']);
              $etudiant->setDepnaiss($record['dep.nai.']);
              $etudiant->setNationalite($record['nation.']);
              $etudiant->setTel($record['port.']);
              $etudiant->setAdresse($record['bur.dis.2'].' '.$record['lib.bdi2']);
              $etudiant->setDerdiplome($record['Der.Dip.']);
              $etudiant->setRegistre($record['Reg.ins.']);
              $etudiant->setStatut($record['Statut']);
              $etudiant->setSports($record['Sport']);
              $etudiant->setHandicape($record['Hand.']);
  
              /*$date_string = $record['D.Ins.'];
              $date_format = 'dd/mm/YYYY';
              $date = DateTimeImmutable::createFromFormat($date_format, $date_string);*/
              
              $etudiant->setEmail($record['Email']);
              $etudiant->setDateinsc(new DateTimeImmutable());
  
              if(!$etudiantRepository->findOneBy(['numetd' => $etudiant->getNumetd()])){;
              $this->entityManager->persist($etudiant);
              $this->entityManager->flush();
              }
        }
        

        // Récupérer tous les étudiants insérés
        $etudiants = $this->entityManager->getRepository(Etudiant::class)->findAll();

       return $this->render('import/import_success.html.twig', [
            'personnes' => $etudiants,
        ]);
    }

    return $this->render('import/import.html.twig', [
        'form' => $form->createView(),
    ]);


       
    }
}
