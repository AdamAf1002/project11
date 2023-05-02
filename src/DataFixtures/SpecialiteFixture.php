<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Specialite;
use Faker;

class SpecialiteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        for($spe=1; $spe<=10; $spe++){

            $specialite = new Specialite();

            $code = "Spe".$spe;
            $specialite->setCodespe($code);
            $specialite->setNomspe($faker->unique()->randomElement(['Maths', 'Ecologie', 'Numérique', 'Physique Chimie', 'Autre', 'SVT', 'Sc Eco', 'Sc Ingénieur', 'Maths expertes', 'Maths complémentaires'])); 

            $manager->persist($specialite);

        }

        $manager->flush();
    }
}
