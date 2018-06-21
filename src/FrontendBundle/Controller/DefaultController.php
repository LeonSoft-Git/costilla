<?php

namespace FrontendBundle\Controller;

use CoreBundle\Entity\Contacto;
use FrontendBundle\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
        return $this->render('FrontendBundle:Default:index.html.twig',array('banners'=>$banners));
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
        return $this->render('FrontendBundle:Default:galeria.html.twig');
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
                    ->setFrom($data['email'])
                    //->setTo(array('contacto@capacitacioninformatica.com'))
                    ->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data['nombre']);
                $contacto->setEmail($data['email']);
                $contacto->setTelefono($data['telefono']);
                $contacto->setMensaje($data['mensaje']);
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

        return $this->render('@Frontend/Default/niveles.html.twig', array(
            'form' => $form->createView(),
            'enviado' => $enviado,
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
                    ->setFrom($data['email'])
                    //->setTo(array('contacto@capacitacioninformatica.com'))
                    ->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data['nombre']);
                $contacto->setEmail($data['email']);
                $contacto->setTelefono($data['telefono']);
                $contacto->setMensaje($data['mensaje']);
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

        return $this->render('@Frontend/Default/inscripciones.html.twig', array(
            'form' => $form->createView(),
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
                    ->setFrom($data['email'])
                    //->setTo(array('contacto@capacitacioninformatica.com'))
                    ->setTo(array('cesar.rios@capacitacioninformatica.com'))
                    ->setBody(
                        $this->renderView('@Frontend/mail/contact.html.twig',array('contacto'=>$data,)),
                        'text/html'
                    )
                ;
                $contacto = new Contacto();
                $contacto->setNombre($data['nombre']);
                $contacto->setEmail($data['email']);
                $contacto->setTelefono($data['telefono']);
                $contacto->setMensaje($data['mensaje']);
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
}
