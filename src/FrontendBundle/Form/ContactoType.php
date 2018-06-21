<?php

namespace FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class)
            ->add('telefono',TextType::class)
            ->add('mensaje',TextareaType::class,array('attr'=>array('rows'=>'5')))
            ->add('email',EmailType::class)
            ->add('enviar',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'CoreBundle\Entity\Contacto'));
    }

    public function getBlockPrefix()
    {
        return 'frontend_bundle_contacto_type';
    }
}
