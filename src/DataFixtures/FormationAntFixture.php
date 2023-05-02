<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\FormationAnt;
use Faker;

class FormationAntFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        $spees = ['Prépa PCSI', 'IUT GE2I', 'Licence Informatique', 'DAEU B', 'DUT réseau et télécom', 'Polytech', 'Ecole D\'ingénieurs', 'Prépa MPSI', 'Licence Histoire', 'Santé', 'Licence Lettre', 'IFSI', 'BTS SIO', 'Pluripass', 'BUT génie civil', 'IUT informatique', 'Licence Math-Informatique', 'Licence Droit', 'CPGE TSI', 'Médecine', 'PACES', 'BTS Conception Produits Industriels', 'études universitaires générales', 'prépa scientifique ESEO', 'L1 Science de la matière', 'Licence mathématiques', 'Licence SVT'];

        for($form=1; $form<=count($spees); $form++){

            $formation = new FormationAnt();

            $code = "Formation".$form;
            $formation->setCodef($code);
            $formation->setNomf($faker->unique()->randomElement($spees));
            $etab = "university at ".$faker->city();
            $formation->setEtablissement($etab);
            $formation->setDiplome($faker->randomElement(['OUI', 'NON']));

            $manager->persist($formation);

        }

        $manager->flush();
    }
}
