<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Choix;
use App\Entity\Etudiant;
use App\Entity\Specialite;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ChoixFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        //récupérer les etudiants
        $etudiants = $manager->getRepository(Etudiant::class)->findAll();

        foreach ($etudiants as $etudiant) 
        {
            $faker = Faker\Factory::create('fr_FR');
            
            //récupérer les Specialites
            $specialites = $manager->getRepository(Specialite::class)->findAll();

            // les 2 choix maintenus
            $this->ajoutChoix( $manager, $etudiant, 1, $specialites, $faker);
            $this->ajoutChoix( $manager, $etudiant, 1, $specialites, $faker);

            // le choix abandonné en terminale
            $this->ajoutChoix( $manager, $etudiant, 0, $specialites, $faker);

        }

        $manager->flush();
    }

    public function ajoutChoix($manager, $etudiant, $bool, $specialites, $faker){
        $choix = new Choix();
        $choix->setEtudiant($etudiant);
        $choix->setSpecialite($faker->unique()->randomElement($specialites));
        $choix->setEnterminale($bool);
        $manager->persist($choix);
    }

    public function getDependencies()
    {
        return [
            EtudiantFixture::class,
            SpecialiteFixture::class
        ];
    }

}
