<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Element;

class ElementFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for($elt=1; $elt<=120; $elt++){

            $element = new Element();
            
            $code = "Element".$elt;
            $element->setCodeelt($code);
            
            $manager->persist($element);

        }

        $manager->flush();
    }
}
