<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CompetitionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('logoFile', VichImageType::class, array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
            ->add('bjcpCompetitionId')
            ->add('hostName')
            ->add('hostLocation')
            ->add('hostUrl')
            ->add('registrationOpen', DateTimeType::class , [
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('registrationClose', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('entryOpen', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('entryClose', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('dropOffOpen', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('dropOffClose', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('shippingOpen', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('shippingClose', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
            ->add('lockDown', DateTimeType::class , [
    'required' => false,
    'widget' => 'single_text',
    'format' => 'YYYY-MM-DD HH:mm',
    'attr' => [
        'class' => 'form-control input-inline datepicker',
        'data-provide' => 'datepicker',
        'data-date-format' => 'YYYY-MM-DD hh:mm'
    ]
])
        ;

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Competition'
        ));
    }
}
