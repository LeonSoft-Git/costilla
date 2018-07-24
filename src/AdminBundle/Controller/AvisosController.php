<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Avisos;

/**
 * Avisos controller.
 *
 * @Route("/avisos")
 */
class AvisosController extends Controller
{
    /** index test
     * Lists all Avisos entities.
     *
     * @Route("/", name="avisos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avisos = $em->getRepository('CoreBundle:Avisos')->findAll();

        return $this->render('avisos/index.html.twig', array(
            'avisos' => $avisos,
        ));
    }

    /**
     * Creates a new Avisos entity.
     *
     * @Route("/new", name="avisos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $aviso = new Avisos();
        $form = $this->createForm('CoreBundle\Form\AvisosType', $aviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($aviso->getImagen()){
                $file = $aviso->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move($this->getParameter('avi_directory'),$fileName);

                $aviso->setImagen($fileName);
            }
            $aviso->setUsuarios($user);
            $em->persist($aviso);
            $em->flush();

            return $this->redirectToRoute('avisos_show', array('id' => $aviso->getId()));
        }

        return $this->render('avisos/new.html.twig', array(
            'aviso' => $aviso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Avisos entity.
     *
     * @Route("/{id}", name="avisos_show")
     * @Method("GET")
     */
    public function showAction(Avisos $aviso)
    {
        $deleteForm = $this->createDeleteForm($aviso);

        return $this->render('avisos/show.html.twig', array(
            'aviso' => $aviso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Avisos entity.
     *
     * @Route("/{id}/edit", name="avisos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Avisos $aviso)
    {
        $deleteForm = $this->createDeleteForm($aviso);
        $editForm = $this->createForm('CoreBundle\Form\AvisosType', $aviso);
        $tmp = $aviso->getImagen();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            if($aviso->getImagen()){
                $file = $aviso->getImagen();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('avi_directory'), $fileName);

                $aviso->setImagen($fileName);
            }else{
                $aviso->setImagen($tmp);
            }
            $aviso->setUsuarios($user);
            $em->persist($aviso);
            $em->flush();

            //return $this->redirectToRoute('avisos_edit', array('id' => $aviso->getId()));
            return $this->redirectToRoute('avisos_index');

        }

        return $this->render('avisos/edit.html.twig', array(
            'aviso' => $aviso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Avisos entity.
     *
     * @Route("/{id}", name="avisos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Avisos $aviso)
    {
        $form = $this->createDeleteForm($aviso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            unlink($this->getParameter('avi_directory').'/'.$aviso->getImagen());
            $em->remove($aviso);
            $em->flush();
        }

        return $this->redirectToRoute('avisos_index');
    }

    /**
     * Creates a form to delete a Avisos entity.
     *
     * @param Avisos $aviso The Avisos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avisos $aviso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avisos_delete', array('id' => $aviso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
