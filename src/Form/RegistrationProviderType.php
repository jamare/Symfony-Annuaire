<?php

namespace App\Form;

use App\Entity\Provider;
use App\Entity\Localite;
use App\Entity\CodePostal;
use App\Entity\Services;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationProviderType extends AbstractType
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
            ->add('phone', TelType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone Mobile',
                ),
            ))
            ->add('web', UrlType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Site Web - format: http://www.monsite.be',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Email',
                ),
            ))
            ->add('emailContact', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Email Pro',
                ),
            ))
            ->add('tva', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Numéro de TVA',
                ),
            ))
            ->add('services', EntityType::class, array(
                'label' =>' ',
                'class' => Services::class,
                'placeholder' => 'Services',
                //'empty_data' => null,
                'mapped' => false,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('password', PasswordType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Mot de passe',
                ),
            ))
            ->add('passwordConfirm', PasswordType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Veuillez confirmer votre mot de pass ...'
                ),
            ))
            ->add('submit',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provider::class,
        ]);
    }
}
