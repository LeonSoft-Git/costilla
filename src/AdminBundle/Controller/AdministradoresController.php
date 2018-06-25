<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Usuarios;

/**
 * Usuarios controller.
 *
 * @Route("/administradores")
 */
class AdministradoresController extends Controller
{
    /** index test
     * Lists all Administradores entities.
     *
     * @Route("/", name="administradores_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('CoreBundle:Usuarios')->findBy(array('tipo'=>2));

        return $this->render('administradores/index.html.twig', array(
            'administradores' => $usuarios,
        ));
    }

    /**
     * Creates a new Usuarios entity.
     *
     * @Route("/new", name="administradores_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuario = new Usuarios();
        $form = $this->createForm('CoreBundle\Form\AdministradoresType', $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuario->setTipo(2);
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('administradores_show', array('id' => $usuario->getId()));
        }

        return $this->render('administradores/new.html.twig', array(
            'administrador' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Usuarios entity.
     *
     * @Route("/{id}", name="administradores_show")
     * @Method("GET")
     */
    public function showAction(Usuarios $usuario)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2 && $usuario->getTipo()==1){
            return $this->redirect($this->generateUrl('administradores_index'));
        }
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('administradores/show.html.twig', array(
            'administrador' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuarios entity.
     *
     * @Route("/{id}/edit", name="administradores_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuarios $usuario)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2 && $usuario->getTipo()==1){
            return $this->redirect($this->generateUrl('administradores_index'));
        }

        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('CoreBundle\Form\AdministradoresType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuario->setTipo(2);
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('administradores_index');

        }

        return $this->render('administradores/edit.html.twig', array(
            'administrador' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuarios entity.
     *
     * @Route("/{id}", name="administradores_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuarios $usuario)
    {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('administradores_index');
    }

    /**
     * Creates a form to delete a Usuarios entity.
     *
     * @param Usuarios $usuario The Usuarios entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuarios $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('administradores_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
