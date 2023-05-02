<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Bac;
use Faker;

class BacFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        for($line=1; $line<=10; $line++){
            $bac = new Bac();
            $bac->setIdbac($faker->unique()->numberBetween(1,10));
            $bac->setTypebac($faker->randomElement(['BAC Général', 'Etranger', 'S', 'ST2S', 'ES','STI2D', 'STL', 'BAC Pro', 'BAC Technique', 'STMG']));
            if($bac->getTypebac() == 'Etranger'){
                $bac->setDepbac(99);
                $e = "etablissement_"."99";
                $bac->setEtabbac($e);
            } else {
                $bac->setDepbac($faker->postcode());
                $num = $faker->numberBetween(1,3);
                $e = "etablissement_".$num;
                $bac->setEtabbac($e);
            }

            $manager->persist($bac);
        }

        $manager->flush();
    }
}
