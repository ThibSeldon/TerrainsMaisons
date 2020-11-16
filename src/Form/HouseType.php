<?php

namespace App\Form;

use App\Entity\House;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom du modèle'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                'Plain-Pied' =>'plain-pied',
                'Etage' => 'etage',
                'Combles Amémagées' => 'combles_amenagees',
                ]
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
            ->add('brand', ChoiceType::class, [
                'choices' => [
                    'Maisons Berdin' => 'maisons_berdin',
                    'Natilia' => 'natilia',
                    'Villas Club' => 'villas_club',
                ]
            ])
            ->add('roofing', ChoiceType::class, [
                'label' => 'Toiture',
                'choices' => [
                    'Toiture Traditionnelle' => 'toiture_traditionnelle',
                    'Toiture BacAcier' => 'toiture bacacier',
                    'Toiture Terrasse' => 'toiture_terrasse',
                ]
            ])
            ->add('length', NumberType::class, [
                'label' => 'Longeur'
            ])
            ->add('width', NumberType::class, [
                'label' => 'Largeur'
            ])
            ->add('height', NumberType::class, [
                'label' => 'Hauteur'
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
