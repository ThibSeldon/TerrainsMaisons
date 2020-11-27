<?php

namespace App\Form;

use App\Entity\Admin\House\HouseBrand;
use App\Entity\Admin\House\HouseModel;
use App\Entity\House;
use App\Entity\Admin\House\HouseRoofing;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


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
            ->add('valid', CheckboxType::class, [
                'label' => 'Model Validé ? ',
                'required' => false,
            ])
            ->add('planFilename', TextType::class, [
                'disabled' => true,
            ])
            ->add('deleteFile', CheckboxType::class, [
                'label' => 'Supprimer le Plan',
                'required' => false,
                'mapped' => false,
            ])
            ->add('uploadPlan', FileType::class, [
                'label' => 'Plans PDF',
                'mapped' => false,
                'required' => false,

                //'placeholder' => 'Selectionner un fichier',
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '5000k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]
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
