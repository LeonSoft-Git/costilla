<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComentariosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $request = Request::createFromGlobals();
        $nuevo = $request->getRequestUri();
        if(false !== strpos($nuevo, 'new')) {
            $builder->add('comentario',TextareaType::class,array('label'=>'Respuesta'));
        }else{
            $builder->add('comentario',TextareaType::class,array('attr'=>array('disabled'=>'disabled')))->add('activo');
        }
}

/**
* {@inheritdoc}
*/
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => 'CoreBundle\Entity\Comentarios'
));
}

/**
* {@inheritdoc}
*/
public function getBlockPrefix()
{
return 'corebundle_comentarios';
}


}
