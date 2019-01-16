<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Localite;
use App\Entity\CodePostal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
               'label' => ' ',
               'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Nom',
                ),
            ))
            ->add('firstName', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Prénom',
                ),
            ))
            ->add('adress', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Adresse',
                ),
            ))
            ->add('adressNumber', NumberType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Numéro',
                ),
            ))
            ->add('codePostal', EntityType::class, array(
                'label' =>' ',
                'class' => CodePostal::class,
                'placeholder' => 'Code Postal ',
                'empty_data' => null,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('localite', EntityType::class, array(
                'label' =>' ',
                'class' => Localite::class,
                'placeholder' => 'Localite ',
                'empty_data' => null,
                'attr' => array('class' => 'form-control'),
                ))
            ->add('email', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                ),
            ))
            ->add('password', PasswordType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Mot de passe',
                ),
            ))
            ->add('newsletter', CheckboxType::class, array(
                'attr' => array('class' => 'form-control'),
                'label' => 'Je m\'abonne à la newsletter',
                'required' => false
            ))
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
