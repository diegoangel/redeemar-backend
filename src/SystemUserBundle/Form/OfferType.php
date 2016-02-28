<?php

namespace SystemUserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campaignName')
            ->add('startDate', 'datetime')
            ->add('endDate', 'datetime')
            ->add('imagePath')
            ->add('prepay')
            ->add('payOnValidate')
            ->add('fixedAmount')
            ->add('percentage')
            ->add('redeemarsForValidation')
            ->add('redeemarPrice')
            ->add('redeemarsUsed')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Redeemar\Entity\Offer'
        ));
    }
}
