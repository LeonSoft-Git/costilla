<?php

namespace CoreBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array('required'=>true))
            ->add('imagen',FileType::class,array('required'=>false,'data_class'=>null,'attr'=>array('ruta'=>'avisos'),'label'=>'Imagen'))
            ->add('mensaje',CKEditorType::class)
            ->add('slug',TextType::class,array('attr'=>array('disabled'=>'disabled')))
            ->add('activo')
            ;
}

/**
* {@inheritdoc}
*/
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'CoreBundle\Entity\Avisos'
));
}

/**
* {@inheritdoc}
*/
public function getBlockPrefix()
{
return 'corebundle_avisos';
}


}
