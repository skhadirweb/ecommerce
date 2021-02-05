<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Votre pseudo',
                'attr' => [
                    'placeholder' => 'Entrez votre pseudo'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Entrez votre ville'
                ]
            ])
            ->add('slogan', ChoiceType::class, [
                'label' => 'Ville',
                'choices' => [
                    'A jamais les premiers' => true,
                    'On craint déguns' => true,
                    'T\'es fadas !' => true,
                    'Amoureux de Marseille' => true,
                    'Plein y\'en a assez' => true
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Choisissez une image'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter au panier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
