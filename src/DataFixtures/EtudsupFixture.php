<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etudiant;
use App\Entity\FormationAnt;
use App\Entity\Etudsup;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class EtudsupFixture extends Fixture implements DependentFixtureInterface
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
            $etdsup = new Etudsup();
            
            //récupérer les formations
            $formations = $manager->getRepository(FormationAnt::class)->findAll();

            $etdsup->setEtudiant($etudiant);
            $etdsup->setFormation($faker->randomElement($formations));
            $etdsup->setAnneedeb($faker->numberBetween(2015,2020));

            $manager->persist($etdsup);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EtudiantFixture::class,
            FormationAntFixture::class
        ];
    }
}
