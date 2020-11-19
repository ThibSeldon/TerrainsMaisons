<?php

namespace App\Form\House;

use App\Entity\Admin\House\HouseRoofing;
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
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'plain-pied' => 'Plain-Pied',
                    'etage' => 'Etage',
                    'Combles Amémagées' => 'combles_amenagees',
                ]
            ])
            ->add('houseRoofing', EntityType::class, [
                'class' => HouseRoofing::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
