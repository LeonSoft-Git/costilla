<?php

namespace FrontendBundle\Controller;

use CoreBundle\Entity\Comentarios;
use CoreBundle\Entity\Contacto;
use CoreBundle\Entity\Usuarios;
use FrontendBundle\Form\ComentarioType;
use FrontendBundle\Form\ContactoType;
use FrontendBundle\Form\RegistroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $banners = $em->getRepository('CoreBundle:Banners')->findBy(array('activo'=>1));
        $avisos = $em->getRepository('CoreBundle:Avisos')->findBy(array('activo'=>1),array('created_at'=>'ASC'),3);
        $num = array();
        foreach ($avisos as $item):
            $conteo = $em->getRepository('CoreBundle:Comentarios')->findBy(array('activo'=>1,'tipo'=>1,'avisos'=>$item));
            array_push($num,array('id'=>$item->getId(),'num'=>count($conteo)));
        endforeach;
        return $this->render('FrontendBundle:Default:index.html.twig',array('banners'=>$banners,'avisos'=>$avisos,'num'=>$num));
    }

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction()
    {
        return $this->render('FrontendBundle:Default:acerca.html.twig');
    }

    /**
     * @Route("/galeria", name="galeria")
     */
    public function galeriaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $fotos = $em->getRepository('CoreBundle:Fotos')->findBy(array('activo'=>1));
        return $this->render('FrontendBundle:Default:galeria.html.twig',array('fotos'=>$fotos));
    }

    /**
     * @Route("/avisos/{page}", name="avisos")
     * @Method("GET")
     */
    public function avisosAction($page  = 1)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user=='anon.'){
            return $this->redirect($this->generateUrl('homepage'));
        }
        $em = $this->getDoctrine()->getManager();

        $limit = 9;
        $avisos = $em->getRepository('CoreBundle:Avisos')->getAllPers($page, $limit);
        $avisosResultado = $avisos['paginator'];
        $avisosQueryCompleta =  $avisos['query'];

        $num = array();
        foreach ($avisosResultado as $item):
            $conteo = $em->getRepository('CoreBundle:Comentarios')->findBy(array('activo'=>1,'tipo'=>1,'avisos'=>$item));
            array_push($num,array('id'=>$item->getId(),'num'=>count($conteo)));
        endforeach;

        $maxPages = ceil($avisos['paginator']->count() / $limit);

        return $this->render('FrontendBundle:Default:avisos.html.twig',array(
            'avisos' => $avisosResultado,
            'maxPages'=>$maxPages,
            'thisPage' => $page,
            'num'=>$num,
            'all_items' => $avisosQueryCompleta
        ));
    }

    /**
     * @Route("/niveles-educativos", name="niveles")
     */
    public function nivelesAction(Request $request){
        $form = $this->createForm(ContactoType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'contacto-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Miguel Hidalgo y Costilla WebPage - Contacto')
                    ->setFrom($data->getEmail())
                    //->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setTo(array('fradelrio@hotmail.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data->getNombre());
                $contacto->setEmail($data->getEmail());
                $contacto->setTelefono($data->getTelefono());
                $contacto->setMensaje($data->getMensaje());
                $em->persist($contacto);
                $em->flush();
                $this->get('mailer')->send($message);

                $enviado=1;
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }
        $avisos = $em->getRepository('CoreBundle:Avisos')->findBy(array('activo'=>1),array('created_at'=>'ASC'),6);
        return $this->render('@Frontend/Default/niveles.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado,
            'avisos'=>$avisos
        ));
    }

    /**
     * @Route("/inscripciones", name="inscripciones")
     */
    public function inscripcionesAction(Request $request){
        $form = $this->createForm(ContactoType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'contacto-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Miguel Hidalgo y Costilla WebPage - Contacto')
                    ->setFrom($data->getEmail())
                    //->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setTo(array('fradelrio@hotmail.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data->getNombre());
                $contacto->setEmail($data->getEmail());
                $contacto->setTelefono($data->getTelefono());
                $contacto->setMensaje($data->getMensaje());
                $em->persist($contacto);
                $em->flush();
                $this->get('mailer')->send($message);

                $enviado=1;
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }
        $avisos = $em->getRepository('CoreBundle:Avisos')->findBy(array('activo'=>1),array('created_at'=>'ASC'),6);
        return $this->render('@Frontend/Default/inscripciones.html.twig', array(
            'form' => $form->createView(),
            'avisos'=>$avisos,
            'enviado' => $enviado,
        ));
    }

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contactoAction(Request $request){
        $form = $this->createForm(ContactoType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'contacto-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Miguel Hidalgo y Costilla WebPage - Contacto')
                    ->setFrom($data->getEmail())
                    //->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setTo(array('fradelrio@hotmail.com','cesar.rios@capacitacioninformatica.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data->getNombre());
                $contacto->setEmail($data->getEmail());
                $contacto->setTelefono($data->getTelefono());
                $contacto->setMensaje($data->getMensaje());
                $em->persist($contacto);
                $em->flush();
                $this->get('mailer')->send($message);

                $enviado=1;
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }

        return $this->render('@Frontend/Default/contacto.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado,
        ));
    }

    /**
     * @Route("/registrarse", name="registrar")
     */
    public function registrarAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user!='anon.'){
            return $this->redirect($this->generateUrl('homepage'));
        }
        $form = $this->createForm(RegistroType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'registro-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();
                $check1 = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('email'=>$data->getEmail()));
                $check2 = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('user'=>$data->getUser()));

                if($check1 || $check2){
                    if($check1){
                        $form->get('email')->addError(new FormError('Email ya existe'));
                    }
                    if($check2){
                        $form->get('user')->addError(new FormError('Usuario ya existe'));
                    }
                    $enviado = 2;
                }else{
                    $message = \Swift_Message::newInstance()
                    ->setSubject('Miguel Hidalgo y Costilla WebPage - Registro')
                    ->setFrom($data->getEmail())
                    //->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setTo(array('fradelrio@hotmail.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/register.html.twig',array('usuario'=>$data,)),
                        'text/html'
                    )
                ;
                    $usuario = new Usuarios();
                    $usuario->setNombre($data->getNombre());
                    $usuario->setApellido($data->getApellido());
                    $usuario->setEmail($data->getEmail());
                    $usuario->setUser($data->getUser());
                    $usuario->setPassword($data->getPassword());
                    $usuario->setActivo(1);
                    $usuario->setTipo(3);
                    $em->persist($usuario);
                    $em->flush();
                    $this->get('mailer')->send($message);

                    $enviado=1;
                }
            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }

        return $this->render('@Frontend/Default/signup.html.twig',array(
            'form' => $form->createView(),
            'enviado' => $enviado
        ));
    }

    /**
     * @Route("/aviso/{slug}", name="aviso-pagina")
     */
    public function avisoPaginaAction(Request $request,$slug){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user=='anon.'){
            return $this->redirect($this->generateUrl('homepage'));
        }
        $form = $this->createForm(ComentarioType::class,null,array(
            'method' => 'POST',
            'attr'=>array('id'=>'comentario-form')
        ));
        $enviado=0;
        $em = $this->getDoctrine()->getManager();
        $aviso = $em->getRepository('CoreBundle:Avisos')->findOneBy(array('slug'=>$slug));

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){
                $data = $form->getData();
                $user = $this->get('security.token_storage')->getToken()->getUser();

                if(gettype($user)=='string'){
                    $usuario = $em->getRepository('CoreBundle:Usuarios')->findOneBy(array('user'=>'developer'));
                }else{
                    $usuario = $user;
                }

                $message = \Swift_Message::newInstance()
                    ->setSubject('Comentario en la Pagina Web')
                    ->setFrom($usuario->getEmail())
                    //->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setTo(array('fradelrio@hotmail.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/comentario.html.twig',array('comentario'=>$data,'aviso'=>$aviso,'usuario'=>$usuario)),
                        'text/html'
                    )
                ;

                $check = $em->getRepository('CoreBundle:Comentarios')->findOneBy(array('usuarios'=>$usuario,'avisos'=>$aviso,'comentario'=>$data->getComentario()));
                if(!$check){
                    $comentario = new Comentarios();
                    $comentario->setActivo(1);
                    $comentario->setComentario($data->getComentario());
                    $comentario->setTipo(1);
                    $comentario->setAvisos($aviso);
                    $comentario->setUsuarios($usuario);
                    $em->persist($comentario);
                    $em->flush();
                    $this->get('mailer')->send($message);
                    $enviado=1;
                }else{
                    $enviado=2;
                }

            }else{
                $enviado=0;
            }
        }else{
            $enviado=0;
        }

        $comentarios = $em->getRepository('CoreBundle:Comentarios')->findBy(array('avisos'=>$aviso,'tipo'=>1));
        $respuestas = $em->getRepository('CoreBundle:Comentarios')->findBy(array('avisos'=>$aviso,'tipo'=>2));
        $avisos = $em->getRepository('CoreBundle:Avisos')->findAll();

        $conteo = $em->getRepository('CoreBundle:Comentarios')->findBy(array('activo'=>1,'tipo'=>1,'avisos'=>$aviso));
        $num = count($conteo);

        $archivos = $em->getRepository('CoreBundle:Archivos')->findBy(array('activo'=>1,'avisos'=>$aviso));

        return $this->render('@Frontend/Default/aviso-pagina.html.twig',array(
            'aviso'=>$aviso,
            'avisos'=>$avisos,
            'enviado'=>$enviado,
            'respuestas'=>$respuestas,
            'num'=>$num,
            'archivos'=>$archivos,
            'comentarios'=>$comentarios,
            'form' => $form->createView()
        ));
    }
}
