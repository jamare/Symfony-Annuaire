<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Customer;
use Faker;

class CustomerFixtures extends Fixture
{
    public const USER_CUSTOMER = 'user-customer';

    public function load(ObjectManager $manager)
    {
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 internautes
        for ($i = 0; $i < 10; $i++) {
            $customer = new Customer();
            $customer->setName($faker->name);
            $customer->setFirstName($faker->firstName);
            $customer->setNewsletter(true);
            $customer->setAdress($faker->streetAddress);
            $customer->setAdressNumber($faker->building_number);
            $customer->setVille($faker->city);   //---> Localité ??
            $customer->setCodePostal($faker->postcode);      //---> CP ??
            $customer->setBanished(false);
            $customer->setEmail($faker->email);
            $customer->setConfirmed(true);
            $customer->setRegistration($faker->dateTimeBetween('-365 days', '-1 days'));
            $customer->setPassword(symfony);
            $customer->setAttempt(1);
            $manager->persist($personne);
        }

        $manager->flush();
        $this->addReference(self::USER_CUSTOMER, $userCustomer);
    }

}
