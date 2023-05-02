<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etudiant;
use App\Entity\Bac;
use App\Entity\Resultatbac;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ResultatbacFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        //récupérer les etudiants
        $etudiants = $manager->getRepository(Etudiant::class)->findAll();

        $faker = Faker\Factory::create('fr_FR');

        foreach ($etudiants as $etudiant) 
        {
            $bac = new Resultatbac();
            
            //récupérer les bacs
            $bacs = $manager->getRepository(Bac::class)->findAll();

            $bac->setEtudiant($etudiant);
            $bac->setBac($faker->randomElement($bacs));
            $bac->setAnneebac($faker->numberBetween(2015,2020));
            $bac->setMention($faker->randomElement(['B', 'Passable', 'TB', 'Excellent', ""]));
            switch ($bac->getMention()) {
                case 'B':
                    $bac->setMoyennebac($faker->randomFloat(2,12,14));
                    break;

                case 'Passable':
                    $bac->setMoyennebac($faker->randomFloat(2,10,12));
                    break;
                
                case 'TB':
                    $bac->setMoyennebac($faker->randomFloat(2,14,16));
                    break;
                
                case 'Excellent':
                    $bac->setMoyennebac($faker->randomFloat(2,16,19));
                    break;
                
                default:
                    $bac->setMoyennebac($faker->randomFloat(2,0,9));
                    break;
            }

            $manager->persist($bac);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EtudiantFixture::class,
        ];
    }

}
