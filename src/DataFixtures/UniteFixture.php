<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Unite;
use App\Entity\Element;
use App\Entity\Bloc;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class UniteFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        //récupérer les blocs de la filière L1 existantes dans la base de données
        $blocsL1 = $manager->getRepository(Bloc::class)->findBy(['filiere' => 'L1']);

        $numelt = 1;
        //récupérer un element specifique de la base de données
        $elements = $manager->getRepository(Element::class)->findAll();

        
        foreach ($blocsL1 as $bloc) {
        
            switch ($bloc->getNombloc()) {
                case 'Développement':
                    $this->ajoutUnite($manager, "Développement web", $bloc->getCodebloc(), $elements[$numelt-1], 4);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Linux", $bloc->getCodebloc(), $elements[$numelt-1], 2);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Développement Python", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Base de données", $bloc->getCodebloc(), $elements[$numelt-1], 4);
                    ++$numelt;
                    break;
                case 'Fondements et algorithmique':
                    $this->ajoutUnite($manager, "Algorithmique", $bloc->getCodebloc(), $elements[$numelt-1], 15);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Fondements de l'informatique", $bloc->getCodebloc(), $elements[$numelt-1], 6);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Base d'informatique", $bloc->getCodebloc(), $elements[$numelt-1], 1);
                    ++$numelt;
                    break;
                case 'Mathématiques':
                    $this->ajoutUnite($manager, "Analyse élémentaire", $bloc->getCodebloc(), $elements[$numelt-1], 5);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Algèbre élémentaire", $bloc->getCodebloc(), $elements[$numelt-1], 5);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Arithmétique dans Z", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    break;
                case 'Enseignements transversaux et indépendants':
                    $this->ajoutUnite($manager, "Anglais", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    $this->ajoutUnite($manager, "EEO", $bloc->getCodebloc(), $elements[$numelt-1], 2);
                    ++$numelt;
                    $this->ajoutUnite($manager, "3PE", $bloc->getCodebloc(), $elements[$numelt-1], 1);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Culture numérique", $bloc->getCodebloc(), $elements[$numelt-1], 1);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Concrétisation", $bloc->getCodebloc(), $elements[$numelt-1], 5);
                    ++$numelt;
                    break;
                
            }

        }

        //récupérer les blocs de la filière L2 existantes dans la base de données
        $blocsL2 = $manager->getRepository(Bloc::class)->findBy(['filiere' => 'L2']);

        foreach ($blocsL2 as $bloc) {
        
            switch ($bloc->getNombloc()) {
                case 'Algorithmique et programmation':
                    $this->ajoutUnite($manager, "Algorithmique 3", $bloc->getCodebloc(), $elements[$numelt-1], 8);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Programmation orientée objet 1", $bloc->getCodebloc(), $elements[$numelt-1], 8);
                    ++$numelt;
                    break;
                case "Fondements et théorie de l’informatique":
                    $this->ajoutUnite($manager, "Fondements de l'informatique 2", $bloc->getCodebloc(), $elements[$numelt-1], 6);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Théorie des langages 1", $bloc->getCodebloc(), $elements[$numelt-1], 6);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Fondements de l'informatique 3", $bloc->getCodebloc(), $elements[$numelt-1], 2);
                    ++$numelt;
                    break;
                case "Technologie de l’informatique":
                    $this->ajoutUnite($manager, "Bases de données 2", $bloc->getCodebloc(), $elements[$numelt-1], 4);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Développement web 2", $bloc->getCodebloc(), $elements[$numelt-1], 6);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Systèmes GNU/Linux et Bash", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Systèmes", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    break;
                case 'Enseignements transversaux et indépendants':
                    $this->ajoutUnite($manager, "Anglais", $bloc->getCodebloc(), $elements[$numelt-1], 4);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Projet personnel et professionnel", $bloc->getCodebloc(), $elements[$numelt-1], 3);
                    ++$numelt;
                    $this->ajoutUnite($manager, "Algèbre linéaire", $bloc->getCodebloc(), $elements[$numelt-1], 7);
                    ++$numelt;
                    break;
                
            }

        }

        $manager->flush();
    }

    public function ajoutUnite($manager, $nomUnite, $codeb, $element, $coef)
    {
        $unite = new Unite();

        $faker = Faker\Factory::create('fr_FR');
        
        $code = "UE_".strtoupper($faker->unique()->lexify('?????', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
        $unite->setCodeunite($code);
        $unite->setNomunite($nomUnite);
        $unite->setCoeficient($coef);
        $respU = strtoupper($faker->lastName())." ".$faker->firstName();
        $unite->setRespunite($respU);

        $unite->setElement($element);

        // à changer
        $bloc = $manager->getRepository(Bloc::class)->find($codeb);
        $unite->setBloc($bloc);

        $manager->persist($unite);

    }

    public function getDependencies()
    {
        return [
            ElementFixture::class,
        ];
    }

}
