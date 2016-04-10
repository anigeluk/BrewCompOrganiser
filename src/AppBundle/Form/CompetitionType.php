<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('logoUrl')
            ->add('bjcpCompetitionId')
            ->add('hostName')
            ->add('hostLocation')
            ->add('hostUrl')
            ->add('registrationOpen')
            ->add('registrationClose')
            ->add('entryOpen')
            ->add('entryClose')
            ->add('dropOffOpen')
            ->add('dropOffClose')
            ->add('shippingOpen')
            ->add('shippingClose')
            ->add('lockDown')
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
