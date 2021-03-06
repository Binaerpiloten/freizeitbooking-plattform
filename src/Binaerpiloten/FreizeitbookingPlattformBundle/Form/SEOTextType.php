<?php

namespace Binaerpiloten\FreizeitbookingPlattformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SEOTextType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heading', null, array('attr' => array('class' => 'form-control')))
            ->add('text', null, array('attr' => array('class' => 'form-control')))
            ->add('title', null, array('attr' => array('class' => 'form-control')))
            ->add('metadescription', null, array('attr' => array('class' => 'form-control')))
            ->add('region', null, array('attr' => array('class' => 'form-control')))
            ->add('category', null, array('attr' => array('class' => 'form-control')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Binaerpiloten\FreizeitbookingPlattformBundle\Entity\SEOText'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binaerpiloten_freizeitbookingplattformbundle_seotext';
    }
}
