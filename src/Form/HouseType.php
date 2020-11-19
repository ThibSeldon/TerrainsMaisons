<?php

namespace App\Form;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\House;
use App\Entity\Admin\House\HouseRoofing;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du modèle'
            ])
            ->add('houseBrand', EntityType::class, [
                'class' => HouseBrand::class,
                'choice_label' => 'name'
            ])
            ->add('houseModel', EntityType::class, [
                'class' => HouseModel::class,
                'choice_label' => 'name'
            ])
            ->add('houseRoofing', EntityType::class, [
                'class' => HouseRoofing::class,
                'choice_label' => 'name',
            ])
            ->add('livingSpace', NumberType::class, [
                'label' => 'Surface Habitable'
            ])
            ->add('annexSurface', NumberType::class, [
                'label' => 'Surface Annexe',
            ])
            ->add('roomNumber', NumberType::class, [
                'label' => 'Nombre de chambre'
            ])
            ->add('bathroomNumber', NumberType::class, [
                'label' => 'Nombre de Salle de Bains'
            ])
            ->add('sellingPriceDf', MoneyType::class, [
                'label' => 'Prix de Vente HT',
            ])
            ->add('length', NumberType::class, [
                'label' => 'Longeur',
                'required' => false
            ])
            ->add('width', NumberType::class, [
                'label' => 'Largeur',
                'required' => false
            ])
            ->add('height', NumberType::class, [
                'label' => 'Hauteur',
                'required' => false
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
