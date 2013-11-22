<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SquashProviderType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('attr' => array('class' => 'form-control')))
            ->add('claim', null, array('attr' => array('class' => 'form-control')))
            ->add('street', null, array('attr' => array('class' => 'form-control')))
            ->add('zip', null, array('attr' => array('class' => 'form-control')))
            ->add('city', null, array('attr' => array('class' => 'form-control')))
            ->add('price', null, array('attr' => array('class' => 'form-control')))
            ->add('telephone', null, array('attr' => array('class' => 'form-control')))
            ->add('website', null, array('attr' => array('class' => 'form-control')))
            ->add('image', null, array('attr' => array('class' => 'form-control')))
            ->add('fieldCount', null, array('attr' => array('class' => 'form-control')))
            ->add('regions', null, array('attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SquashProvider'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_freizeitbookingplattformbundle_squashprovider';
    }
}
