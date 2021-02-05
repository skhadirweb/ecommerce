<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('new_password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message'=> 'Les mots de passe doivent être identiques.',
                'label'=>'Votre nouveau mot de passe',
                'required' => true,
                'first_options'=> [
                    'label'=> 'Mon nouveau mot de passe',
                    'attr'=> [
                        'placeholder' => 'Merci de saisir votre nouveau mot de passe.'
                    ]
                ],
                'second_options'=> [
                    'label'=>'Confirmez votre nouveau mot mot de passe',
                    'attr'=> [
                        'placeholder' => 'Merci de confirmer votre nouveau mot de passe.'
                    ]
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
