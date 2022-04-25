<?php

namespace App\Form;

use App\Entity\Participation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Equipe;
use App\Entity\Matchtb;
use App\Entity\Stade;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('match', EntityType::class, array(
            'class' => Matchtb::class,
            'choice_label' => function ($matchtb) {
                return $matchtb->getTour();
            }

        ))
            ->add('equipe', EntityType::class, array(
                'class' => Equipe::class,
                'choice_label' => function ($equipe) {
                    return $equipe->getNom();
                },
                'placeholder' => 'Equipe1',
            ))
            ->add('equipe2', EntityType::class, array(
                'class' => Equipe::class,
                'choice_label' => function ($equipe) {
                    return $equipe->getNom();
                },
                'placeholder' => 'Equipe2',
            ))
            ->add('stade', EntityType::class, array(
                'class' => Stade::class,
                'choice_label' => function ($stade) {
                    return $stade->getNom();
                },
                'placeholder' => 'stade',
            ))

            ->add('date', DateType::class,['input'  => 'datetime_immutable','widget'=>'choice'
            ])
/*             ->add('longitude')
            ->add('latitude') */
            ->add(
                'Add participation',
                SubmitType::class,
                [
                    'attr' => ['class' => 'btn btn-primary'],
                ]
            )
            
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
