<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\AnneeUniversitaire;
use Faker;

class AnneeUniversitaireFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        
        $faker = Faker\Factory::create('fr_FR');

        for($a=1; $a<=6; $a++){

            $anneeuv = new AnneeUniversitaire();

            $anneeuv->setAnnee($faker->unique()->numberBetween(2018,2023));

            $manager->persist($anneeuv);

        }

        $manager->flush();
    }
}
