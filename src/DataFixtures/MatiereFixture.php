<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Element;
use App\Entity\Matiere;
use App\Entity\Unite;
use App\Entity\Bloc;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class MatiereFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $numelt = 1;
        //récupérer un element specifique de la base de données
        $elements = $manager->getRepository(Element::class)->findAll();

        //récupérer les blocs de la filière L1 existantes dans la base de données
        $blocsL1 = $manager->getRepository(Bloc::class)->findBy(['filiere' => 'L1']);

        foreach ($blocsL1 as $bloc) 
        {
            $unites = $manager->getRepository(Unite::class)->findBy(['bloc' => $bloc->getCodebloc()]);
            switch ($bloc->getNombloc()) {
                case 'Développement':
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Développement web':
                                $this->ajoutMatiere($manager, "Développement web 1", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Linux':
                                $this->ajoutMatiere($manager, "Linux", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Développement Python':
                                $this->ajoutMatiere($manager, "Développement Python", "P3", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Base de données':
                                $this->ajoutMatiere($manager, "Base de données 1", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Base de données 2", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case 'Fondements et algorithmique':
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Algorithmique':
                                $this->ajoutMatiere($manager, "Algorithmique 1 (1/2)", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algorithmique 1 (2/2)", "P3", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algorithmique 2 (1/2)", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algorithmique 2 (2/2)", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Base d'informatique":
                                $this->ajoutMatiere($manager, "Base d'informatique", "P3", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Fondements de l'informatique":
                                $this->ajoutMatiere($manager, "Fondements de l'informatique 1", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Fondements de l'informatique 2", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case "Mathématiques":
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Analyse élémentaire':
                                $this->ajoutMatiere($manager, "Analyse élémentaire* 1", "P1", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Analyse élémentaire* 2", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Algèbre élémentaire':
                                $this->ajoutMatiere($manager, "Algèbre élémentaire* 1", "P1", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algèbre élémentaire* 2", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Arithmétique dans Z':
                                $this->ajoutMatiere($manager, "Arithmétique dans Z", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case 'Enseignements transversaux et indépendants':
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Anglais':
                                $this->ajoutMatiere($manager, "Anglais 1 (1/2)", "P1", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 1 (2/2)", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 2 (1/2)", "P3", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 2 (2/2)", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case '3PE':
                                $this->ajoutMatiere($manager, "3PE (1/2)", "P3", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "3PE (2/2)", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "3PE Enseignant référent - 6h", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'EEO':
                                $this->ajoutMatiere($manager, "EEO (1/2)", "P1", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "EEO (2/2)", "P2", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Culture numérique':
                                $this->ajoutMatiere($manager, "Culture numérique (PIX)", "P4", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Concrétisation':
                                $this->ajoutMatiere($manager, "Concrétisation", "P5", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                
            }
        }




        //récupérer les blocs de la filière L2 existantes dans la base de données
        $blocsL2 = $manager->getRepository(Bloc::class)->findBy(['filiere' => 'L2']);

        foreach ($blocsL2 as $bloc) 
        {
            $unites = $manager->getRepository(Unite::class)->findBy(['bloc' => $bloc->getCodebloc()]);
            switch ($bloc->getNombloc()) {
                case 'Algorithmique et programmation':
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Algorithmique 3':
                                $this->ajoutMatiere($manager, "Algorithmique 3 (1/2)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algorithmique 3 (2/2)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Programmation orientée objet 1':
                                $this->ajoutMatiere($manager, "Programmation orientée objet (1/3)", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Programmation orientée objet (2/3)", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Programmation orientée objet (3/3)", "P10", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case "Fondements et théorie de l’informatique":
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case "Fondements de l'informatique 2":
                                $this->ajoutMatiere($manager, "Fondements de l'informatique 2 (1/2)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Fondements de l'informatique 2 (2/2)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Théorie des langages 1":
                                $this->ajoutMatiere($manager, "Théorie des langages 1 (1/2)", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Théorie des langages 1 (2/2)", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Fondements de l'informatique 3":
                                $this->ajoutMatiere($manager, "Fondements de l'informatique 3", "P10", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case "Technologie de l’informatique":
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case "Bases de données 2":
                                $this->ajoutMatiere($manager, "Bases de données 2 (1/2)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Bases de données 2 (2/2)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Développement web 2":
                                $this->ajoutMatiere($manager, "Développement web 2 (1/3)", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Développement web 2 (2/3)", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Développement web 2 (3/3)", "P10", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Systèmes GNU/Linux et Bash":
                                $this->ajoutMatiere($manager, "Systèmes GNU/Linux et Bash", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case "Systèmes":
                                $this->ajoutMatiere($manager, "Systèmes", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                case 'Enseignements transversaux et indépendants':
                    foreach ($unites as $unite) {
                        switch ($unite->getNomunite()) {
                            case 'Anglais':
                                $this->ajoutMatiere($manager, "Anglais 3 (1/2)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 3 (2/2)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 4 (1/2)", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Anglais 4 (2/2)", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Projet personnel et professionnel':
                                $this->ajoutMatiere($manager, "3PE (1/4)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "3PE (2/4)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "3PE (3/4)", "P8", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "3PE (4/4)", "P9", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                            case 'Algèbre linéaire':
                                $this->ajoutMatiere($manager, "Algèbre linéaire (1/2)", "P6", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                $this->ajoutMatiere($manager, "Algèbre linéaire (2/2)", "P7", $elements[$numelt - 1], $unite->getCodeunite());
                                ++$numelt;
                                break;
                        }
                    }
                    break;
                
            }
        }


        $manager->flush();
    }

    public function ajoutMatiere($manager, $nomMat, $periode, $element, $codeu)
    {
        $matiere = new Matiere();

        $faker = Faker\Factory::create('fr_FR');

        $code = "MT_".strtoupper($faker->unique()->lexify('?????', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
        $matiere->setCodemat($code);
        $matiere->setNommat($nomMat);
        $matiere->setPeriode($periode);

        $matiere->setElement($element);

        // à changer
        $unite = $manager->getRepository(Unite::class)->find($codeu);
        $matiere->setUnite($unite);

        $manager->persist($matiere);
    }

    public function getDependencies()
    {
        return [
            UniteFixture::class,
        ];
    }

}
