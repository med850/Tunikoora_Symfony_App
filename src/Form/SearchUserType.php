<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('cin', TextType::class, array(
            'attr' => array(
                'placeholder' => '...',
                'class' => 'form-control mr-sm-2'
            )
        ))

        ->add('Recherche', SubmitType::class,array(
           
            'attr' => array(
                'class' => ' btn btn-outline-success my-2 my-sm-0'
            )
           
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
