<?php

namespace App\Form\Matching;

use App\Entity\Matching\PlotHouseMatching;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PHMSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('sellingPriceAti', NumberType::class, [
                'label'=> 'Budget Max',
                'scale'=> 0,

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlotHouseMatching::class,
        ]);
    }
}
