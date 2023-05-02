<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
//use App\DataFixtures\UserPasswordHasherInterface
use Faker;

class UserFixture extends Fixture
{

    

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        //user 1
        $admin = new User();
        $admin->setEmail('moussa@demo.fr');
        $admin->setId(1);
        $admin->setNom('Deh');
        $admin->setPrenom('Moussa');
        $admin->setSexe("M");

        $password = 'moussa';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $admin->setPassword($hashedPassword);

        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        //user 2
        $admin = new User();
        $admin->setEmail('adam@univangers.fr');
        $admin->setId(2);
        $admin->setNom('Afif');
        $admin->setPrenom('Adam');
        $admin->setSexe("M");

        $password = 'adam';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $admin->setPassword($hashedPassword);

        $admin->setRoles(['ROLE_USER']);

        $manager->persist($admin);

        //user 
        $admin = new User();
        $admin->setEmail('taise@univangers.fr');
        $admin->setId(3);
        $admin->setNom('Nganga');
        $admin->setPrenom('Taise');
        $admin->setSexe("M");

        $password = 'taise';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $admin->setPassword($hashedPassword);

        $admin->setRoles(['ROLE_USER']);

        $manager->persist($admin);

        $manager->flush();

    }
    
}
