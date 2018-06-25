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
 * @Route("/super")
 */
class SuperController extends Controller
{
    /** index test
     * Lists all Administradores entities.
     *
     * @Route("/", name="super_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('CoreBundle:Usuarios')->findBy(array('tipo'=>1));

        return $this->render('super/index.html.twig', array(
            'administradores' => $usuarios,
        ));
    }

    /**
     * Creates a new Usuarios entity.
     *
     * @Route("/new", name="super_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        $usuario = new Usuarios();
        $form = $this->createForm('CoreBundle\Form\AdministradoresType', $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuario->setTipo(1);
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('super_show', array('id' => $usuario->getId()));
        }

        return $this->render('super/new.html.twig', array(
            'administrador' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Usuarios entity.
     *
     * @Route("/{id}", name="super_show")
     * @Method("GET")
     */
    public function showAction(Usuarios $usuario)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('super/show.html.twig', array(
            'administrador' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuarios entity.
     *
     * @Route("/{id}/edit", name="super_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuarios $usuario)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('CoreBundle\Form\AdministradoresType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $usuario->setTipo(1);
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('super_index');

        }

        return $this->render('super/edit.html.twig', array(
            'administrador' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuarios entity.
     *
     * @Route("/{id}", name="super_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuarios $usuario)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('super_delete');
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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getTipo()==2){
            return $this->redirect($this->generateUrl('admin_home'));
        }
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('super_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
