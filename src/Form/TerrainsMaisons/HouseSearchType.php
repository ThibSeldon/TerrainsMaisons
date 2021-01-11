<?php

namespace App\Form\TerrainsMaisons;

use App\Entity\Admin\House\HouseModel;
use App\Entity\House;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HouseSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roomNumber', ChoiceType::class, [
                'label' => 'Chambres',
                'placeholder' => 'Combien de chambre ?',
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ]
            ])

            ->add('houseModel', EntityType::class, [
                'placeholder' => 'Type de Maison',
                'label' => 'Type',
                'class' => HouseModel::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
