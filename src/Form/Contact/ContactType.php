<?php

namespace App\Form\Contact;

use App\Entity\Contact\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('society', null, [
                'label' => 'Sociétée'
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('phoneNumber')
            ->add('note')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
