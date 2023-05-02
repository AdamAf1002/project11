<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etudiant;
use App\Entity\Element;
use App\Entity\Note;
use App\Entity\AnneeUniversitaire;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class NoteFixture extends Fixture implements DependentFixtureInterface
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
            $note = new Note();

            $note->setEtudiant($etudiant);

            //récupérer les elements
            $elements = $manager->getRepository(Element::class)->findAll();
            $note->setElement($faker->randomElement($elements));

            //récupérer les bacs
            $auvs = $manager->getRepository(AnneeUniversitaire::class)->findAll();
            $note->setAnneeuniversitaire($faker->randomElement($auvs));

            $note->setNote($faker->randomFloat(2,0,20));

            $manager->persist($note);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EtudiantFixture::class,
            ElementFixture::class
        ];
    }

}
