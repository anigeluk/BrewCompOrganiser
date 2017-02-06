<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class LocationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('postcode')
            ->add('website')
            ->add('telephone')
            ->add('imageFile', VichImageType::class, array(
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_link' => true, // not mandatory, default is true
            ))
            ->add('dropoff',
                CheckboxType::class,
                [
                    'label' => 'location.form.dropoff',
                    'attr' => [
                        'align_with_widget' => true
                    ]
                ]

            )
            ->add('shipping',
                CheckboxType::class,
                [
                    'label' => 'location.form.shipping',
                    'attr' => [
                        'align_with_widget' => true
                    ]
                ]

            )
            ->add('judging',
                CheckboxType::class,
                [
                    'label' => 'location.form.judging',
                    'attr' => [
                        'align_with_widget' => true
                    ]
                ]

            )
            ->add('awards',
                CheckboxType::class,
                [
                    'label' => 'location.form.awards',
                    'attr' => [
                        'align_with_widget' => true
                    ]
                ]

            )
            ->add('sponsor',
                CheckboxType::class,
                [
                    'label' => 'location.form.sponsor',
                    'attr' => [
                        'align_with_widget' => true
                    ]
                ]

            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Location'
        ));
    }
}
