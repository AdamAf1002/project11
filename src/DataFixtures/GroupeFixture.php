<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Groupe;
use Faker;

class GroupeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');
            

        $periodes = [1, 2, 3, 4, 5];

        $filieres = ['L1', 'L2', 'L3'];

        // convention : 4 groupes pour chaque filière

        foreach ($filieres as $filiere) {

            for($i=1; $i<=2; $i++){
                $groupe = new Groupe();

                $code = $filiere."I".$i."P".$periodes[0]."-".$periodes[1];
                $groupe->setCodegrp($code);
                $nom = $filiere."-Infor-Grp-".$i;
                $groupe->setNomgrp($nom);
                $groupe->setNbetds(0);
                $groupe->setCapacite(15);

                $manager->persist($groupe);

            }

            for($i=1; $i<=2; $i++){
                $groupe = new Groupe();

                $code = $filiere."I".$i."P".$periodes[2]."-".$periodes[3]."-".$periodes[4];
                $groupe->setCodegrp($code);
                $nom = $filiere."-Info-Grp-".$i;
                $groupe->setNomgrp($nom);
                $groupe->setNbetds(0);
                $groupe->setCapacite(15);
                $manager->persist($groupe);

            }

            //mettre à jour les périodes
            $periodes = array_map(function ($val){
                return $val+5;
            }, $periodes);

        }
            

        $manager->flush();
    }
}
