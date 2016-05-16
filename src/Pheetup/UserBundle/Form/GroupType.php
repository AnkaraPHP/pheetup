<?php

namespace Pheetup\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('domain')
            ->add('description')
            ->add('location')
            ->add('logo', 'file')
            ->add('submit', 'submit');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Pheetup\UserBundle\Entity\Group',
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pheetup_userbundle_group';
    }
}
