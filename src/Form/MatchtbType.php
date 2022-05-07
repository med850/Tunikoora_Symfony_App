<?php

namespace App\Form;

use App\Entity\Matchtb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MatchtbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('localisation',TextType::class,['label'=>'Localisation'])
            ->add('arbitreprincipale',TextType::class,['label'=>'Arbitre principale'])
            ->add('tour',TextType::class,['label'=>'Tour'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matchtb::class,
        ]);
    }
}
