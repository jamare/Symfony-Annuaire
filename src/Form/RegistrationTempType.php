<?php

namespace App\Form;

use App\Entity\TempUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegistrationTempType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
                    'placeholder' => 'Password',
                ),
            ))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Utilisateur privé' => 'customer',
                    'Prestataire de service' => 'provider',
                ),
                'label' => 'Type d\'utilisateur',
            ))
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TempUser::class,
        ]);
    }
}
