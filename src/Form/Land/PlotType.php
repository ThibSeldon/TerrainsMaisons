<?php

namespace App\Form\Land;

use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Land\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lot')
            ->add('surface')
            ->add('facadeWidth')
            ->add('sellingPriceAti')
            ->add('state', EntityType::class, [
                'class' => State::class,
                'choice_label' => 'name',

            ])
            ->add('allotment', EntityType::class, [
                'class' => Allotment::class,
                'choice_label' => 'name',
                'label' => 'Lotissement',
                'placeholder' => 'Selectionner',
                'required' => true,
            ])
            ->add('salesPlan', FileType::class, [
                'label' => 'Plan de vente',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plot::class,
        ]);
    }
}
