<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\DataTransformer\DateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
            ->add('registrationOpen', TextType::class, array(
                'required' => true,
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'class' => 'form-control input-inline datetimepicker',
                    'data-provide' => 'datepicker',
                    'data-format' => 'dd-mm-yyyy HH:ii',
                ),
            ))
            ->add('registrationClose')
            ->add('entryOpen')
            ->add('entryClose')
            ->add('dropOffOpen')
            ->add('dropOffClose')
            ->add('shippingOpen')
            ->add('shippingClose')
            ->add('lockDown')
        ;

         $builder->get('registrationOpen')
            ->addModelTransformer(new DateTimeTransformer());
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
