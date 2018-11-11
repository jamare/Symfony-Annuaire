<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Provider;
use Faker;

class ProviderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=0;$i<10;$i++){
            $provider = new Provider();
            $provider->setName($faker->name);
            $provider->setEmailContact($faker->email);
            $provider->setPhone($faker->phoneNumber);
            $provider->setTva($faker->vat);
            $provider->setWeb($faker->domainName);
            $manager->persist($provider);
        }

        $manager->flush();
    }

}
