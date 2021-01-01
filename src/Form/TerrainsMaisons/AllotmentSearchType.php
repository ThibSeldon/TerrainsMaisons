<?php

namespace App\Form\TerrainsMaisons;

use App\Entity\Land\Allotment;
use App\Entity\Land\SearchAllotment;
use App\Repository\Land\AllotmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllotmentSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', EntityType::class, [
                'label' => 'Chosir une ville',
                'query_builder' => function (AllotmentRepository $ar) {
                    return $ar->createQueryBuilder('a')
                        ->andWhere('a.isValid = true')
                        ->orderBy('a.city', 'ASC');
                },
                'class' => Allotment::class,
                'choice_label' => 'city',
                'required' => false,
                'placeholder' => 'Choisir une ville',
                'multiple' => true,
                'attr' => ['class' => 'select-city'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Allotment::class,
        ]);
    }
}
