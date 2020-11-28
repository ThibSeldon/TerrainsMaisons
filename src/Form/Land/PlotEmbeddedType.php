<?php

namespace App\Form\Land;

use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlotEmbeddedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lot')
            ->add('surface')
            ->add('facadeWidth')
            ->add('sellingPriceAti')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plot::class,
        ]);
    }
}
