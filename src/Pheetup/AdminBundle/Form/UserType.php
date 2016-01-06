<?php

namespace Pheetup\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('password','password')
            ->add('submit','submit',[
              'label'=>'Kaydet'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => 'Pheetup\UserBundle\Entity\Member',
          'label'=>'Kullanıcı Güncelle'
        ]);
    }

    public function getName()
    {
        return 'pheetup_admin_bundle_user_type';
    }
}
