<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Epreuve;
use App\Entity\Element;
use App\Entity\Matiere;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class EpreuveFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $numelt = 1;
        //récupérer un element specifique de la base de données
        $elements = $manager->getRepository(Element::class)->findAll();

        // recupérer toutes les matières de la base de données
        $matieres = $manager->getRepository(Matiere::class)->findAll();

        foreach ($matieres as $matiere) {

            $this->ajoutEpreuve($manager, 1, $matiere->getCodemat(), $elements[$numelt - 1]);
            ++$numelt;
            $this->ajoutEpreuve($manager, 2, $matiere->getCodemat(), $elements[$numelt - 1]);
            ++$numelt;

        }


        $manager->flush();
    }

    public function ajoutEpreuve($manager, $chance, $codem, $element){

        $epreuve = new Epreuve();

        $faker = Faker\Factory::create('fr_FR');

        $code = "EPV_".strtoupper($faker->unique()->lexify('??????', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
        $epreuve->setCodeepreuve($code);
        $nomS = "Salle".$faker->numberBetween(1,10);
        $epreuve->setSalle($nomS);
        $epreuve->setNumchance($chance);
        $epreuve->setDuree($faker->numberBetween(1,4));
        $epreuve->setAnnee($faker->numberBetween(2019, 2023));

        if($chance == 1){
            $epreuve->setTypeepreuve($faker->unique()->randomElement(['CC', 'TP NOTE', 'CT']));
        } else {
            $epreuve->setTypeepreuve("Exam Chance 2");
        }

        $epreuve->setElement($element);

        $matiere = $manager->getRepository(Matiere::class)->find($codem);
        $epreuve->setMatiere($matiere);

        $manager->persist($epreuve);

    }


    public function getDependencies()
    {
        return [
            MatiereFixture::class,
        ];
    }

}
