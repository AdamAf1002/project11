<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Filiere;
use App\Entity\Element;
use Faker;

class FilereFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        //récupérer un element specifique de la base de données
        $elements = $manager->getRepository(Element::class)->findAll();

        for($f=1; $f<=3; $f++){

            $filiere = new Filiere();

            $code = 'L'.$f;
            $filiere->setCodefiliere($code);
            $nomf = "Licence ".$f." Informatique";
            $filiere->setNomfiliere($nomf);
            $respf = strtoupper($faker->lastName())." ".$faker->firstName();
            $filiere->setRespfiliere($respf);

            $element = $faker->unique()->randomElement($elements);
            $filiere->setElement($element);

            $manager->persist($filiere);

        }

        $manager->flush();
    }
}
