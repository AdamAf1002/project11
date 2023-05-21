<?php

namespace App\Controller;

use App\Entity\Bac;
use App\Entity\Note;
use App\Entity\Groupe;
use DateTimeImmutable;
use App\Entity\Element;
use App\Entity\Filiere;
use App\Entity\Etudiant;
use App\Entity\Resultatbac;
use App\Entity\AnneeUniversitaire;
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
        $query = $this->entityManager->createQuery('DELETE FROM ' . Note::class);
        $query->execute();

        // Insertion
        foreach ($csvData as $record) {
            
           

            //creation du bac
            if(!empty($record['bac'])&&!$this->entityManager->getRepository(Bac::class)->findOneBy(["typebac"=>$record['bac']])){
                $bac=new Bac();
                $bac->setTypebac($record['bac']);
                $this->entityManager->persist($bac);
                $this->entityManager->flush();
                
            }

            //creation de l'etudiant

            if(!empty($record['Cod.etu.'])&&!$this->entityManager->getRepository(Etudiant::class)->findOneBy(["numetd"=>$record['Cod.etu.']])){
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
            $date_string = $record['date nai.'];
              $date = \DateTime::createFromFormat('d/m/Y', $date_string);
            $etudiant->setDatnaiss($date);
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
  
              $date_string = $record['D.Ins.'];
              $date = \DateTime::createFromFormat('d/m/Y', $date_string);
              
              $etudiant->setEmail($record['Email']);
              $etudiant->setDateinsc($date);
  
              //validation sur la base de données
              $this->entityManager->persist($etudiant);
              $this->entityManager->flush();
              

            }    

            //creation de l'element 
            if(!empty($record['etp'])&&!$this->entityManager->getRepository(Element::class)->findOneBy(["codeelt"=>$record['etp']])){
               $element =new Element();
               $element->setCodeelt($record['etp']);
               $this->entityManager->persist($element);
               $this->entityManager->flush();

            }
      //creation de la filière à partir de l'element 
      $element=$this->entityManager->getRepository(Element::class)->findOneBy(["codeelt"=>$record['etp']]);
      if(!empty($record['lib.etp'])&&!$this->entityManager->getRepository(Filiere::class)->findOneBy(["nomfiliere"=>$record['lib.etp']])){
        $filiere =new Filiere;
        $filiere->setNomfiliere($record['lib.etp']);
        $filiere->setElement($element);
        $this->entityManager->persist($filiere);
        $this->entityManager->flush();

     }
     //creation du resulatat du bac de l'etudiant
     $etudiant=$this->entityManager->getRepository(Etudiant::class)->findOneBy(["numetd"=>$record['Cod.etu.']]);
     $bac=$this->entityManager->getRepository(Bac::class)->findOneBy(["typebac"=>$record['bac']]);
     if((!empty($record['Cod.etu.'])&&!empty($record['bac']))&&!$this->entityManager->getRepository(Resultatbac::class)->findOneBy(["bac"=>$bac,"etudiant"=>$etudiant])){
        $resultatbac=new Resultatbac();
        $resultatbac->setEtudiant($etudiant);
        $resultatbac->setBac($bac);
        $resultatbac->setAnneebac(intval($record['Ann.3']));
        $resultatbac->setMention($record['men.']);
        $resultatbac->setEtabbac($record['Etab.']);
        $this->entityManager->persist($resultatbac);
        $this->entityManager->flush();
     }
     //creation de l'année universitaire
     $date_string = $record['D.Ins.'];
     $date = \DateTime::createFromFormat('d/m/Y', $date_string);
     $annee=$date->format('Y'); 
     if(!$this->entityManager->getRepository(AnneeUniversitaire::class)->findOneBy(["annee"=>$annee])){
        $anneeuniversitaire=new AnneeUniversitaire();
        $anneeuniversitaire->setAnnee(intval($annee));
        $this->entityManager->persist($anneeuniversitaire);
        $this->entityManager->flush();

     }

   
     //creation de la note 
     $anneeuniversitaire=$this->entityManager->getRepository(AnneeUniversitaire::class)->findOneBy(["annee"=>$annee]);
     if(!$this->entityManager->getRepository(Note::class)->findOneBy(["anneeuniversitaire"=>$anneeuniversitaire,"etudiant"=>$etudiant,"element"=>$element])){
      $note=new Note();
      $note->setAnneeuniversitaire($anneeuniversitaire);
      $note->setEtudiant($etudiant);
      $note->setElement($element);
      $this->entityManager->persist($note);
        $this->entityManager->flush();



     }
        }
       
   //creation de groupe
   $groupes=$this->creergroupes($element,$anneeuniversitaire,35);
        // Récupérer tous les étudiants insérés
        $etudiants = $this->entityManager->getRepository(Note::class)->findAll();

       return $this->render('import/import_success.html.twig', [
            'personnes' => $groupes,
        ]);
    }

    return $this->render('import/import.html.twig', [
        'form' => $form->createView(),
    ]);


       
    }



    /**
     * fonction permetant de creer les groupes d'etudiant d'une filière
     *elementf correspond à l'element de la filière
     * $nombreMaxEtudiantsParGroupe nombre maximale d'etudiant par groupe
     * return l'ensemble de groupes créer
     *
     * @param Element $elementf
     * @param AnneeUniversitaire $anneeuniversitaire
     * @param integer $nombreMaxEtudiantsParGroupe
     * @return array
     */
function creergroupes(Element $elementf,AnneeUniversitaire $anneeuniversitaire, int $nombreMaxEtudiantsParGroupe):array {
    $groupes=[];
  
 $notes=$elementf->getNotes();
 $etudiants=[];
 foreach ($notes as $key => $value) {
    array_push($etudiants,$value->getEtudiant());
 }

 //trie les etudiant en fonction de leur nom
 usort($etudiants,function($a,$b){
    if($a->getNom()==$b->getNom())
      return 0 ;
      else
      return $a->getNom()>$b->getNom()?1:-1;
 });

// Calculer le nombre total d'étudiants et le nombre de groupes nécessaires
    $nombreEtudiants = count($etudiants);
    $nombreGroupes = ceil($nombreEtudiants / $nombreMaxEtudiantsParGroupe);

// Calculer le nombre d'étudiants par groupe en respectant la proportion
$nombreEtudiantsParGroupe = ceil($nombreEtudiants / $nombreGroupes);

    //creation de groupes
    $etudiantsRestants = $nombreEtudiants;
    $groupeActuel = 0;

    //des groupes d'etudiants
    foreach ($etudiants as $etudiant) {
        $etudiant->setGroupe(null);
         $this->entityManager->persist($etudiant);
         $this->entityManager->flush();
    }
    //suppression de tous groupes de la filière
    $query = $this->entityManager->createQuery('DELETE FROM ' . Groupe::class);
    $query->execute();
    foreach ($etudiants as $etudiant) {
      if (!isset($groupes[$groupeActuel])) {
            $groupe = new Groupe(); // Créer une nouvelle instance de l'entité Groupe
            $codegroupe=substr($elementf->getFiliere()->getNomfiliere(),0,2);
            $codegroupe.="-infor-grp-".$groupeActuel+1;
            $groupe->setCodegrp($codegroupe);
            $nomgroupe="groupe ".$groupeActuel+1;
            $groupe->setNomgrp($nomgroupe);
            $groupe->setCapacite($nombreMaxEtudiantsParGroupe);
            $groupe->setNbetds(0);
            $this->entityManager->persist($groupe);
            $this->entityManager->flush();
           $groupes[$groupeActuel]=$groupe;     
      }   
      $groupes[$groupeActuel]=$this->entityManager->getRepository(Groupe::class)->findOneBy(["codegrp"=>$groupes[$groupeActuel]->getCodegrp()]);    
       $etudiant->setGroupe($groupes[$groupeActuel]);
       $groupes[$groupeActuel]->setNbetds($groupes[$groupeActuel]->getNbetds()+1);
       $groupes[$groupeActuel]->addEtudiant($etudiant);
       $this->entityManager->persist($groupes[$groupeActuel]);
        $this->entityManager->persist($etudiant);
        $this->entityManager->flush();
       $etudiantsRestants--;

       if(count($groupes[$groupeActuel]->getEtudiants()) >= $nombreEtudiantsParGroupe || $etudiantsRestants <= 0) {
            $groupeActuel++;
       }
    }
  
    return $groupes;
  }

}






?>
