<?php

namespace App\Form\Land;

use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Land\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plot::class,
        ]);
    }
}
