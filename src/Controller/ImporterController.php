<?php

namespace App\Controller;

use App\Entity\Element;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ImporterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/importer', name: 'app_importer')]
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('csv_file', FileType::class, [
                'attr'=>['class' =>'form-control'],
                'label'=>'CSV file: '
                ])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $csvFile = $form->get('csv_file')->getData();
            // Traiter le fichier CSV et renvoyer les données
            // ...
            $file = fopen($csvFile->getPathname(), 'r');
            $csvData = [];
           
            // Lire la première ligne comme entête
            //$headers = fgetcsv($file);
           
            while (($data = fgetcsv($file)) !== false) {
            //$rowData = [];
            /*foreach ($headers as $index => $header) {
            $rowData[$header] = $data[$index] ?? null;
            }*/
            $csvData[] = $data;
            }
           
            fclose($file);
           
            // suppression du contenu de la table personne
            /*$query = $this->entityManager->createQuery('DELETE FROM ' . Personne::class);
            $query->execute();
           */
            // Insertion
            foreach ($csvData as $row) {
                foreach($row as $r){
                    $tab=explode("\n",$r);
                   if(count($tab) >=3){
                    $element=new Element();
                    $element->setCodeelt($tab[0]);
                   $this->entityManager->persist($element);
                   }
                }
            }
            $this->entityManager->flush();
           
            // Récupérer tous les étudiants insérés
            $elements= $this->entityManager->getRepository(Element::class)->findAll();
           
            return $this->render('importer/success.html.twig', [
            'donnees' => $elements,
            ]);
        }
        return $this->render('importer/index.html.twig', [
            'controller_name' => 'ImporterController',
            'form'=>$form->createView()
        ]);
    }
}
