<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('display_start', DateType::class,array(

            ))
            ->add('display_end', DateType::class, array(

            ))
            ->add('start', DateType::class, array(

            ))
            ->add('end', DateType::class, array(

            ))
            ->add('description', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('price', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('additional_information', TextType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
