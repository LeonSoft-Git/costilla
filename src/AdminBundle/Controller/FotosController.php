<?php

namespace AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CoreBundle\Entity\Fotos;

/**
 * Fotos controller.
 *
 * @Route("/fotos")
 */
class FotosController extends Controller
{
    /** index test
     * Lists all Fotos entities.
     *
     * @Route("/", name="fotos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fotos = $em->getRepository('CoreBundle:Fotos')->findAll();

        return $this->render('fotos/index.html.twig', array(
            'fotos' => $fotos,
        ));
    }

    /**
     * Creates a new Fotos entity.
     *
     * @Route("/new", name="fotos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $foto = new Fotos();
        $form = $this->createForm('CoreBundle\Form\FotosType', $foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($foto->getUrl()){
                $file = $foto->getUrl();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();

                $file->move($this->getParameter('gal_directory'),$fileName);

                $foto->setUrl($fileName);
            }

            $em->persist($foto);
            $em->flush();

            return $this->redirectToRoute('fotos_show', array('id' => $foto->getId()));
        }

        return $this->render('fotos/new.html.twig', array(
            'foto' => $foto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Fotos entity.
     *
     * @Route("/{id}", name="fotos_show")
     * @Method("GET")
     */
    public function showAction(Fotos $foto)
    {
        $deleteForm = $this->createDeleteForm($foto);

        return $this->render('fotos/show.html.twig', array(
            'foto' => $foto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Fotos entity.
     *
     * @Route("/{id}/edit", name="fotos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Fotos $foto)
    {
        $deleteForm = $this->createDeleteForm($foto);
        $editForm = $this->createForm('CoreBundle\Form\FotosType', $foto);
        $tmp = $foto->getUrl();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($foto->getUrl()){
                $file = $foto->getUrl();

                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('gal_directory'), $fileName);

                $foto->setUrl($fileName);
            }else{
                $foto->setUrl($tmp);
            }

            $em->persist($foto);
            $em->flush();

            //return $this->redirectToRoute('fotos_edit', array('id' => $foto->getId()));
            return $this->redirectToRoute('fotos_index');

        }

        return $this->render('fotos/edit.html.twig', array(
            'foto' => $foto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Fotos entity.
     *
     * @Route("/{id}", name="fotos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Fotos $foto)
    {
        $form = $this->createDeleteForm($foto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            unlink($this->getParameter('gal_directory').'/'.$foto->getUrl());
            $em->remove($foto);
            $em->flush();
        }

        return $this->redirectToRoute('fotos_index');
    }

    /**
     * Creates a form to delete a Fotos entity.
     *
     * @param Fotos $foto The Fotos entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fotos $foto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fotos_delete', array('id' => $foto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
