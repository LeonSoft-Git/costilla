<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Comentarios;

/**
 * Comentarios controller.
 *
 * @Route("/comentarios")
 */
class ComentariosController extends Controller
{
    /** index test
     * Lists all Comentarios entities.
     *
     * @Route("/", name="comentarios_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comentarios = $em->getRepository('CoreBundle:Comentarios')->findBy(array('tipo'=>1));
        $respuestas = $em->getRepository('CoreBundle:Comentarios')->findBy(array('tipo'=>2));
        $check = array();
        foreach ($respuestas as $r):
            array_push($check,$r->getRespuesta());
        endforeach;

        return $this->render('comentarios/index.html.twig', array(
            'comentarios' => $comentarios,
            'check'=>$check
        ));
    }

    /**
     * Creates a new Comentarios entity.
     *
     * @Route("/new/{id}", name="comentarios_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$id)
    {
        $comentario = new Comentarios();
        $form = $this->createForm('CoreBundle\Form\ComentariosType', $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $c = $em->getRepository('CoreBundle:Comentarios')->findOneBy(array('id'=>$id));
            $comentario->setAvisos($c->getAvisos());
            $comentario->setUsuarios($c->getUsuarios());
            $comentario->setActivo(1);
            $comentario->setTipo(2);
            $comentario->setRespuesta($id);
            $em->persist($comentario);
            $em->flush();

            return $this->redirectToRoute('comentarios_index');
        }

        return $this->render('comentarios/new.html.twig', array(
            'comentario' => $comentario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Comentarios entity.
     *
     * @Route("/{id}", name="comentarios_show")
     * @Method("GET")
     */
    public function showAction(Comentarios $comentario,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $respuesta = $em->getRepository('CoreBundle:Comentarios')->findOneBy(array('respuesta'=>$id));
        return $this->render('comentarios/show.html.twig', array(
            'comentario' => $comentario,
            'respuesta'=>$respuesta
        ));
    }

    /**
     * Displays a form to edit an existing Comentarios entity.
     *
     * @Route("/{id}/edit", name="comentarios_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Comentarios $comentario)
    {
        $editForm = $this->createForm('CoreBundle\Form\ComentariosType', $comentario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comentario);
            $em->flush();

            //return $this->redirectToRoute('comentarios_edit', array('id' => $comentario->getId()));
            return $this->redirectToRoute('comentarios_index');

        }

        return $this->render('comentarios/edit.html.twig', array(
            'comentario' => $comentario,
            'edit_form' => $editForm->createView()
        ));
    }
}
