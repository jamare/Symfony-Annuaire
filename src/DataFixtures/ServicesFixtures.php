<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Services;
use Faker\Factory;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=1;$i<=10;$i++){
            $services = new Services();
            $services->setName($faker->sentence());

            $description = '<p>' . join($faker->paragraphs(3), '</p><p>') . '</p>';
            $services->setDescription($description);

            $services->setValid(true);
            if($i<5){
                $services->setForward(1);
            }else{
                $services->setForward(0);
            }
            $this->setReference("service_".$i, $services);
            $manager->persist($services);
        }

        $manager->flush();
    }
}
