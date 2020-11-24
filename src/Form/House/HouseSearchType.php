<?php

namespace App\Form\House;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\Admin\House\HouseRoofing;
use App\Entity\House;
use App\Entity\Admin\House\SearchHouse;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//FORMULAIRE DE RECHERCHE POUR LE CATALOGUE DE MAISONS
class HouseSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder


            ->add('houseModel', EntityType::class, [
                'label' => 'Type de Maison',
                'class' => HouseModel::class,
                'choice_label' => 'name',
                'placeholder' => 'Tous Types',
                'required' => false,
                
            ])

            ->add('houseBrand', EntityType::class, [
                'label' => 'Marque',
                'class' => HouseBrand::class,
                'choice_label' => 'name',
                'placeholder' => 'Toutes Marques',
                'required' => false, 
                
                ],               
           )
            ->add('roomNumber', ChoiceType::class, [
                'label' => 'Nombre de chambres',
                'choices'  => [
                    'Tous' => null,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('searchSellingPriceAti', NumberType::class, [
                'label' => 'Prix Vente Max',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix Max',
                ]
            ])
            ->add('length', NumberType::class, [
                'label' => 'Longeure Max',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Longeur Max'
                ]
            ])
            ->add('valid', CheckboxType::class, [
                'label' => 'Model Validé ? ',
                'required' => false,
                'attr' => [
                    'checked' => true
                ]
                
                
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
