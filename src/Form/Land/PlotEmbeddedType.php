<?php

namespace App\Form\Land;

use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Land\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlotEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lot', null, [
                'label' => "lot",
            ])
            ->add('surface', null, [
                'label' => 'surface m2',
            ])
            ->add('facadeWidth', null, [
                'label' => 'Largeur Facade',
                'required' => true,
            ])
            ->add('sellingPriceAti', null, [
                'label' => 'Prix de vente'
            ])
            ->add('state', EntityType::class, [
                'class' => State::class,
                'choice_label' => 'name',

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
