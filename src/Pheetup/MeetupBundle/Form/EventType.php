<?php

namespace Pheetup\MeetupBundle\Form;

use Pheetup\UserBundle\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',"text",[
                "label"=>"Etkinlik Adı"
            ])
            ->add(
                'group',
                'entity',
                [
                    'class' => 'PheetupUserBundle:Group',
                    'choice_label' => 'name',
                ]
            )
            ->add('start','datetime',[
                "label" => "Etkinlik Ne Zaman Başlıyor",
                "date_widget" => "single_text",
                "time_widget" => "single_text",
            ])
            ->add('finish','datetime',[
                "label" => "Etkinlik Ne Zaman Bitiyor",
                "date_widget" => "single_text",
                "time_widget" => "single_text",
            ])
            ->add('location','text',[
                "label"=>"Etkinlik Nerede"
            ])
            ->add('description','textarea',[
                "label"=>"Etkinlik Detayları"
            ])
            ->add('submit','submit')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pheetup\MeetupBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pheetup_meetupbundle_event';
    }

}
