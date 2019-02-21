<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    //injection des dépendances par le constructeur, Symfony ne nous le passera pas par la fonction load
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    const AMOUNT_CP = 6;
    const AMOUNT_LOCALITE = 3;
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=1;$i<=15;$i++){
            $customer = new Customer();

            $password = $this->encoder->encodePassword($customer, 'password');

            $customer->setName($faker->lastName());
            $customer->setFirstName($faker->firstName());
            $customer->setNewsletter(rand(0,1));
            $customer->setAdress($faker->streetAddress);
            $customer->setAdressNumber($faker->randomDigit);
            $randCP = rand(1,self::AMOUNT_CP);
            $customer->setCodePostal($this->getReference('cp_'.$randCP));
            $customer->setLocalite($this->getReference('localite_'.$randCP.'_'.rand(1,self::AMOUNT_LOCALITE)));
            $customer->setEmail($faker->email);
            $customer->setPassword($password);
            $customer->setRegistration($faker->dateTimeBetween('-365 days', '-1 days'));
            $customer->setConfirmed(1);
            $customer->setAttempt(0);
            $customer->setBanished(false);

            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LocaliteFixtures::class,
        );

    }
}
