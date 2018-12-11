<?php

namespace App\DataFixtures;


use App\Entity\CodePostal;
use App\Entity\Localite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class LocaliteFixtures extends Fixture
{

    const AMOUNT_CP = 6;
    const AMOUNT_LOCALITE = 3;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=1;$i<= self::AMOUNT_CP;$i++) {
            $codePostal = new CodePostal();
            $codePostal->setCp($faker->numberBetween(4000,5000));
            $this->setReference('cp_'.$i,$codePostal);
            $manager->persist($codePostal);

            // création de localité
            for ($j = 1; $j <= self::AMOUNT_LOCALITE; $j++) {
                $localite = new Localite();
                $localite->setLocalite($faker->city);
                $this->setReference('localite_'.$i.'_'.$j,$localite);
                $manager->persist($localite);
            }
        }

        $manager->flush();
    }

}
