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
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Bloc;
use App\Entity\Epreuve;
use App\Entity\Matiere;
use App\Entity\Unite;

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
                'label'=>' Joindre un fichier CSV : '
            ])

            ->add('annee', NumberType::class, [
                'attr'=>[
                    'class'=>'form-control',
                    'minlength'=>'4',
                    'maxlength'=>'4',
                ],
                'label'=>'Annee 2019->Now :',
                'constraints' => [
                   // new Assert\Length(['min' => 2019, 'max' => '']),
                    new Assert\NotBlank(),
                ]
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

            $query4 = $this->entityManager->createQuery('DELETE FROM ' . Epreuve::class);
            $query4->execute();

            $query3 = $this->entityManager->createQuery('DELETE FROM ' . Matiere::class);
            $query3->execute();

            $query3 = $this->entityManager->createQuery('DELETE FROM ' . Unite::class);
            $query3->execute();

            $query2 = $this->entityManager->createQuery('DELETE FROM ' . Bloc::class);
            $query2->execute();
           
            // suppression du contenu de la table personne
            $query = $this->entityManager->createQuery('DELETE FROM ' . Element::class);
            $query->execute();

            
           
            // Insertion
            foreach ($csvData as $row) {
                foreach($row as $r){
                    $tab=explode("\n",$r);
                   if(count($tab) >=3){

                        $element=new Element();
                        $element->setCodeelt($tab[0]);
                        $this->entityManager->persist($element);

                        if (strpos(strtoupper($tab[1]), "BLOC") !== false){
                            $bloc = new Bloc();
                            $bloc->setCodebloc($tab[0]);
                            $bloc->setNombloc($tab[1]);
                            $bloc->setElement($element);
                            $this->entityManager->persist($bloc);
                        }

    

                        if ((strpos(strtoupper($tab[1]), "CC") !== false) || (strpos(strtoupper($tab[1]), "TP") !== false) || (strpos(strtoupper($tab[1]), "AS") !== false) || (strpos(strtoupper($tab[1]), "RA") !== false)){
                            $matiere = new Matiere();
                            $matiere->setCodemat($tab[0]);
                            $matiere->setNommat(substr($tab[1], 3));
                            $matiere->setElement($element);
                            $matiere->setPeriode("P".substr($tab[1], -1));
                            //$matiere->setUnite($unite);
                            $this->entityManager->persist($matiere);


                            $epreuve = new Epreuve();
                            $epreuve->setCodeepreuve($tab[0]);
                            $epreuve->setNumchance(1);
                            $epreuve->setAnnee($form->get('annee')->getData());
                            $epreuve->setTypeepreuve(substr($tab[1],0,2));
                            $epreuve->setElement($element);
                            $epreuve->setMatiere($matiere);
                            $this->entityManager->persist($epreuve);
                        }

                        else if ((strpos(strtoupper($tab[1]), "CT") !== false)){
                            $epreuve = new Epreuve();
                            $epreuve->setCodeepreuve($tab[0]);
                            $epreuve->setNumchance(2);
                            $epreuve->setAnnee($form->get('annee')->getData());
                            $epreuve->setTypeepreuve(substr($tab[1],0,2));
                            $epreuve->setElement($element);
                            $this->entityManager->persist($epreuve);
                        }

                        


                   }
                }
            }
            $this->entityManager->flush();
           
            // Récupérer tous les étudiants insérés
            $elements= $this->entityManager->getRepository(Element::class)->findAll();

            $blocs= $this->entityManager->getRepository(Bloc::class)->findAll();
           
            return $this->render('importer/success.html.twig', [
                'donnees' => $elements,
                'blocs' => $blocs
            ]);
        }
        return $this->render('importer/index.html.twig', [
            'controller_name' => 'ImporterController',
            'form'=>$form->createView()
        ]);
    }

    public function appartient($ch){
        for ($i = 1; $i <= 15; $i++){
            $sch = "P".$i;
            if (strpos($ch, $sch) == false) {
                return false;
                break;
            }
        }
        return true;
    }
}
