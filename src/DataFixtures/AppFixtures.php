<?php

namespace App\DataFixtures;

use App\Entity\CodePostal;
use App\Entity\Provider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Services;
use Faker;

class CPFixtures extends Fixture
{
    public const CP_REFERENCE = 'cp-ref';
    public function load(ObjectManager $manager){

        $cps = array();

        for($i=0;$i<10;$i++){
            $cp = new CodePostal();
            $cp->setCp(4000+$i);
            $cps[]=$cp;
            $manager->persist($cp);
        }
        $this->addReference(self::CP_REFERENCE,$cps);

        $manager->flush();
    }
}

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i<= 15; $i++){
            $service = new Services();
            $service->setName("Service N°$i")
                    ->setDescription("Description du service n°$i")
                    ->setForward(false)
                    ->setValid(true);
            $manager->persist($service);
        }


        for($j=0;$j<10;$j++){
            $provider = new Provider();
            $provider->setName($faker->name);
            $provider->setEmailContact($faker->email);
            $provider->setPhone($faker->phoneNumber);
            $provider->setTva($faker->vat);
            $provider->setWeb($faker->domainName);
            $provider->setAdress($faker->streetAddress);
            $provider->setAdressNumber($faker->buildingNumber);
            $provider->setCodePostal($faker->postCode);
            $provider->setLocalite($faker->city);
            $provider->setEmail($faker->email);
            $provider->setPhone($faker->phoneNumber);
            $provider->setPassword($faker->password);
            $provider->setConfirmed(1);
            $provider->setAttempt(0);
            $provider->setBanished(0);

            $manager->persist($provider);
        }

        $manager->flush();
    }

}
