<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Bloc;
use App\Entity\Element;
use App\Entity\Filiere;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class BlocFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $blocsL1 = ["Enseignements transversaux et indépendants", "Mathématiques", "Fondements et algorithmique", "Développement"];
        $blocsL2 = ["Algorithmique et programmation", "Fondements et théorie de l’informatique", "Technologie de l’informatique", "Enseignements transversaux et indépendants"];
        //$blocsL3 = [];

        $this->remplirBlocsfilieres("L1", $blocsL1, $manager);

        $this->remplirBlocsfilieres("L2", $blocsL2, $manager);

        $manager->flush();

    }


    public function remplirBlocsfilieres($f, $donnees, $manager){
        
        $faker = Faker\Factory::create('fr_FR');

        for($i=1; $i<=count($donnees); $i++){

            $bloc = new Bloc();

            $code = "CB_".strtoupper($faker->unique()->lexify('?????', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
            $bloc->setCodebloc($code);
            $bloc->setNombloc($faker->unique()->randomElement($donnees));

            if($bloc->getNombloc() != "Enseignements transversaux et indépendants")
            {
                $bloc->setNoteplancher($faker->numberBetween(6,7));
            }

            //récupérer un element specifique de la base de données
            $elements = $manager->getRepository(Element::class)->findAll();
            $element = $faker->unique()->randomElement($elements);
            $bloc->setElement($element);

            // à changer
            $filiere = $manager->getRepository(Filiere::class)->find($f);
            $bloc->setFiliere($filiere);

            $manager->persist($bloc);

        }

    }

    public function getDependencies()
    {
        return [
            ElementFixture::class,
        ];
    }

}
