<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Etudiant;
use App\Entity\Groupe;
use Faker;
use DateTimeImmutable;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EtudiantFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        //récupérer tous les groupes de la base de données
        $groupes = $manager->getRepository(Groupe::class)->findAll();


        //créer des étudiants tout en les ajoutant dans les groupes
        foreach ($groupes as $groupe) {
            // Générer un nombre aléatoire d'étudiants pour chaque groupe
            $nbEtudiants = $faker->numberBetween($min = 7, $max = 14);

            for($etd=1; $etd<=$nbEtudiants; $etd++){

                $etudiant = new Etudiant();

                $num = "9".$faker->randomNumber(7);
                $etudiant->setNumetd($num);
                $etudiant->setNom($faker->lastName());
                $etudiant->setSexe($faker->randomElement(['M','F']));

                if($etudiant->getSexe() == 'F'){
                    $etudiant->setPrenom($faker->firstNameFemale());
                } else {
                    $etudiant->setPrenom($faker->firstNameMale());
                }
                $etudiant->setEmail(strtolower($etudiant->getPrenom()).'.'.strtolower($etudiant->getNom()).'@etud.univ-angers.fr');
                $etudiant->setAdresse($faker->address());
                $etudiant->setTel($faker->phoneNumber('+33'));

                $dateOfBirth = $faker->dateTimeBetween('-30 years', '-18 years');
                $dateOfBirthImmutable = DateTimeImmutable::createFromMutable($dateOfBirth);
                $etudiant->setDatnaiss($dateOfBirthImmutable);

                $etudiant->setPaysnaiss($faker->randomElement(['France', 'Etranger']));

                if($etudiant->getPaysnaiss() == 'France'){
                    $etudiant->setVillnaiss($faker->city());
                    $etudiant->setDepnaiss($faker->postcode());
                    $etudiant->setNationalite('Français');
                } else {
                    $etudiant->setVillnaiss('Ville à l\'étranger');
                    $etudiant->setDepnaiss('99');
                    $etudiant->setNationalite('Etranger');
                }

                $etudiant->setSports($faker->randomElement(['FootBall', 'BasketBall', 'Tennis', 'Natation', 'Pas de Sports']));
                $etudiant->setHandicape($faker->randomElement(['Moteur', 'Visuel', 'Auditif', 'Mental']));
                $etudiant->setDerdiplome($faker->randomElement(['Baccalauréat', 'Licence', 'Certificat de qualification professionnelle', 'Diplôme universitaire de technologie', 'Diplôme établissement étranger', 'BTS', 'Aucun diplôme supérieur']));
                $etudiant->setRegistre($faker->randomElement(['initiale', 'FP']));
                $etudiant->setStatut($faker->randomElement(['étudiant', 'Formation professionnelle']));

                $dateInsc = $faker->dateTimeBetween('-3 years', '-1 years');;
                $dateInscImmutable = DateTimeImmutable::createFromMutable($dateInsc);
                $etudiant->setDateinsc($dateInscImmutable);
        
                // groupe
                $etudiant->setGroupe($groupe);
                
                // mettre à jour le nombre d'étudiants inscrits dans le groupe
                $groupe->setNbetds($groupe->getNbEtds() + 1);

                // inserer la ligne
                $manager->persist($etudiant);

            }

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GroupeFixture::class,
        ];
    }

}
