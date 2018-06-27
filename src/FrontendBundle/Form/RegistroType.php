<?php

namespace FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nombre',TextType::class,array(
            'required'=>true
        ))
            ->add('apellido',TextType::class,array(
                'required'=>true
            ))
            ->add('email',EmailType::class,array(
                'required'=>true
            ))
            ->add('user',TextType::class,array(
                'required'=>true
            ))
            ->add('password',PasswordType::class,array(
                'required'=>true
            ))
            ->add('registrar',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'CoreBundle\Entity\Usuarios'));
    }

    public function getBlockPrefix()
    {
        return 'frontend_bundle_registro_type';
    }
}
