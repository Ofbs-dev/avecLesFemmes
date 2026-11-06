<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\TypeCampagne;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la campagne',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Saisir le nom de la campagne',
                ],
            ])
            ->add('dateDebutAt', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'input' => 'datetime',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('dateFinAt', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'input' => 'datetime',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('montant', IntegerType::class, [
                'label' => 'Montant (FCFA)',
                'attr' => [
                    'class' => 'form-control',
                    'min' => 0,
                ],
            ])
            ->add('typeCampagne', EntityType::class, [
                'class' => TypeCampagne::class,
                'choice_label' => 'nom',
                'label' => 'Type de campagne',
                'placeholder' => 'Choisir un type',
                'attr' => [
                    'class' => 'form-select',
                ],
            ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
