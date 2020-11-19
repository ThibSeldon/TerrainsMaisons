<?php

namespace App\Form\House;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\Admin\House\HouseRoofing;
use App\Entity\House;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HouseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('houseModel', EntityType::class, [
                'class' => HouseModel::class,
                'choice_label' => 'name'
            ])
            ->add('houseBrand', EntityType::class, [
                'class' => HouseBrand::class,
                'choice_label' => 'name',
            ])
            ->add('roomNumber', RangeType::class, [
                'attr' => [
                    'min' => 2,
                    'max' => 4,
                ]
            ])
            ->add('testSellingPriceAti', NumberType::class, [
                'attr' => [
                    'placeholder' => 'Prix Max',
                ]
            ] )
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
