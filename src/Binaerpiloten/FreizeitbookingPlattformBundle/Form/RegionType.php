<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('attr' => array('class' => 'form-control')))
            ->add('urlname', null, array('attr' => array('class' => 'form-control')))
            ->add('description', null, array('attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\FreizeitbookingPlattformBundle\Entity\Region'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_freizeitbookingplattformbundle_region';
    }
}
