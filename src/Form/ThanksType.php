<?php

namespace App\Form;

use App\Entity\Thanks;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThanksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('fromWho', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'name',
            'label' => 'De la part de'
        ])
        ->add('toWho', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'name',
            'label' => 'Pour qui ?'
        ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'rows' => 3,
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Thanks::class,
        ]);
    }
}
