<?php

namespace App\Form;

use App\Entity\Customer;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Nom", "Votre nom ..."))
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom ..."))
            ->add('adress', TextType::class, $this->getConfiguration("Adresse", "Votre adresse ..."))
            ->add('adressNumber', NumberType::class, $this->getConfiguration("Numéro", "Numéro"))
            ->add('codePostal', NumberType::class, $this->getConfiguration("CP", "Votre code postal ..."))
            ->add('localite', TextType::class, $this->getConfiguration("localité", "Votre localité"))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de pass", "Choisissez un mot de pass"))
            ->add('submit',SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
