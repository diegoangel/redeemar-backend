<?php

namespace OwnerUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use OwnerUserBundle\Form\CompanyType;
use Ivory\GoogleMap\Places\AutocompleteComponentRestriction;
use Ivory\GoogleMap\Places\AutocompleteType;

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
            ->add('address','places_autocomplete', array(

                // Autocomplete types
                'types'  => array(
                    AutocompleteType::GEOCODE
                ),

                // TRUE if the autocomplete is loaded asynchonously else FALSE
                'async' => false,

                // Autocomplete component restrictions
                'component_restrictions' => array(
                    AutocompleteComponentRestriction::COUNTRY => 'us'
                ),

                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => ''
                ),
                // Autocomplete language
                'language' => 'en',
                )
            )
            ->add('phone')
            ->add('contact')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Redeemar\Entity\Location'
        ));
    }
}
