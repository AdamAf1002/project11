<?php

namespace App\DataFixtures;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker=Factory::create("fr_FR");

    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        /*
        for ($i=0; $i <3 ; $i++) { 
            $user=new User();
            $user->setSexe(mt_rand(0,1)==1?"F":"M");
            $user->setNom($this->faker->name());
              $user->setPrenom($this->faker->lastName(($user->getSexe()=="F")||($user->getSexe()=="f")?'female':'male'))
              ->setEmail($this->faker->email())
              ->setPlainpassword("password")
              ->setRoles(["ROLE_USER"]);
              
              $manager->persist($user);

        }
        */


        $manager->flush();
    }
}
