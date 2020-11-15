<?php

namespace App\Form;

use App\Entity\House;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('livingSpace')
            ->add('annexSurface')
            ->add('roomNumber')
            ->add('bathroomNumber')
            ->add('sellingPriceDf')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('brand')
            ->add('roofing')
            ->add('length')
            ->add('width')
            ->add('height')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
