<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Localite;
use App\Entity\Provider;
use App\Entity\Services;
use App\Entity\Images;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountProType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('adress', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('adressNumber', NumberType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
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
                    'placeholder' => ' ',
                ),
            ))
            ->add('web', UrlType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('emailContact', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('tva', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ' ',
                ),
            ))
            ->add('services', EntityType::class, array(
                'label' =>' ',
                'class' => Services::class,
                'placeholder' => ' ',
                //'empty_data' => null,
                'multiple' => true,
                'attr' => array('class' => 'form-control'),
            ))
            ->add('imageFile', EntityType::class, array(
                'label' => ' ',
                'class' => Images::class,
                'required' => false,
                'attr' => array('class' => 'form-control'),
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
