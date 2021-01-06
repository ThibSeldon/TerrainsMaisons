<?php

namespace App\Form\Matching;

use App\Entity\Matching\PlotHouseMatching;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlotHouseMatchingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sellingPriceAti')
            ->add('valid')
            ->add('house')
            ->add('plot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlotHouseMatching::class,
        ]);
    }
}
