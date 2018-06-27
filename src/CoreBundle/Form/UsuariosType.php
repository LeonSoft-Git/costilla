<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuariosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('email')
            ->add('user',TextType::class,array('label'=>'Username'))
            ->add('password')
            ->add('activo')
            ->add('valido');
}

/**
* {@inheritdoc}
*/
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'CoreBundle\Entity\Usuarios'
));
}

/**
* {@inheritdoc}
*/
public function getBlockPrefix()
{
return 'corebundle_usuarios';
}


}
