<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Mime\Message;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('cin', NumberType::class)
        ->add('username', TextType::class)
        ->add('prenom', TextType::class)
        ->add('tel', NumberType::class)
        ->add('email',TextType::class)
        ->add('password',PasswordType::class,
        [
            'constraints' => [
                new NotBlank(
                    [
                        'message' => 'Champ vide.'
                    ]
                    ),
                 new Length(
                    [
                            'min' => 8,
                            'minMessage' => 'Le mot de passe doit faire minimum 8 caractère'
                    ]
                    ),

        ]]
        )
        ->add('repeatpassword', PasswordType::class,
        [
            'constraints' => [
                new NotBlank(
                    [
                        'message' => 'Champ vide.'
                    ]
                    ),
                 new Length(
                    [
                            'min' => 8,
                            'minMessage' => 'Le mot de passe doit faire minimum 8 caractère'
                    ]
                    ),
        ]]
        )
        ;
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
