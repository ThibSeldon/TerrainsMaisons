<?php

namespace App\Form\Land;

use App\Entity\Land\Allotment;
use App\Entity\Land\Plot;
use App\Entity\Contact;
use App\Form\Contact\ContactType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AllotmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('postalCode')
            ->add('city')
            ->add('propertyLimit', NumberType::class, [
                'label' => 'Limite de propriété en m',
                'help' => 'laisser 0 si double limite possible',
                'required' => false,
            ])
            ->add('doubleLimit')
            ->add('houseRoofings', null, [
                'label' => 'Type de toiture'
            ])
            ->add('plots', CollectionType::class, [
                'entry_type' => PlotEmbeddedType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('contacts')

            ->add('localUrbanPlanFile', FileType::class,[
                'label' => 'Plan Local d\'Urbanisme',
                'required' => false,
                'mapped' => false,
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
            ->add('regulationFile', FileType::class,[
                'label' => 'Reglement de lotissement',
                'required' => false,
                'mapped' => false,
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
            'data_class' => Allotment::class,

        ]);
    }
}
