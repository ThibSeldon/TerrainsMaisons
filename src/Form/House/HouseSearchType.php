<?php

namespace App\Form\House;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\Admin\House\HouseRoofing;
use App\Entity\House;
use App\Entity\Admin\House\SearchHouse;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HouseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false
            ])

            ->add('houseModel', EntityType::class, [
                'class' => HouseModel::class,
                'choice_label' => 'name'
            ])

            ->add('houseBrand', EntityType::class, [
                'class' => HouseBrand::class,
                'choice_label' => 'name',
                
            ])
            ->add('roomNumber', ChoiceType::class, [
                'choices'  => [
                    'Maybe' => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('testSellingPriceAti', NumberType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix Max',
                ]
            ])
            ->add('length', NumberType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Longeur Max'
                ]
            ])
            ->add('valid', CheckboxType::class, [
                'label' => 'Model Validé ? ',
                'required' => false,
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchHouse::class,
        ]);
    }
}
