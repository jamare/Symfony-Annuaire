<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Customer;
use App\Entity\Role;
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

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new Customer();
        $randCP = rand(1,self::AMOUNT_CP);
        $adminUser->setName('Jamar')
                  ->setFirstName('Eric')
                  ->setNewsletter(rand(0,1))
                  ->setAdress('Rue Lieutenant Simon')
                  ->setAdressNumber('5')
                  ->setCodePostal($this->getReference('cp_'.$randCP))
                  ->setLocalite($this->getReference('localite_'.$randCP.'_'.rand(1,self::AMOUNT_LOCALITE)))
                  ->setPassword($this->encoder->encodePassword($adminUser, 'password'))
                  ->setEmail('eric.jamar@outlook.be')
                  ->setRegistration($faker->dateTimeBetween('-365 days', '-1 days'))
                  ->setConfirmed(1)
                  ->setAttempt(0)
                  ->setBanished(false)
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);

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
