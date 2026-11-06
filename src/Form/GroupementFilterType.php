<?php

namespace App\Form;

use App\DTO\GroupementFilterInput;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupementFilterType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('tel', SearchType::class, [
                'required' => false,
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher par téléphone',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('adresse', SearchType::class, [
                'required' => false,
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Rechercher par adresse',
                ],
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])
            ->add('rechercher', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => [
                    'class' => 'btn btn-primary w-100',
                ],
            ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {
        $resolver->setDefaults([
            'data_class' => GroupementFilterInput::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }
}
