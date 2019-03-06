<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Signaletique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Signaletique controller.
 *
 * @Route("signaletique")
 */
class SignaletiqueController extends Controller
{
    /**
     * Lists all signaletique entities.
     *
     * @Route("/", name="signaletique_index", methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $signaletiques = $em->getRepository('AppBundle:Signaletique')->findAll();

        return $this->render('@App/signaletique/index.html.twig', array(
            'signaletiques' => $signaletiques,
        ));
    }

    /**
     * Creates a new signaletique entity.
     *
     * @Route("/new", name="signaletique_new" , methods={"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $signaletique = new Signaletique();
        $form = $this->createForm('AppBundle\Form\SignaletiqueType', $signaletique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($signaletique);
            $em->flush();

            return $this->redirectToRoute('signaletique_show', array('id' => $signaletique->getId()));
        }

        return $this->render('@App/signaletique/new.html.twig', array(
            'signaletique' => $signaletique,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a signaletique entity.
     *
     * @Route("/{id}", name="signaletique_show", methods={"GET"})
     */
    public function showAction(Signaletique $signaletique)
    {
        $deleteForm = $this->createDeleteForm($signaletique);

        return $this->render('@App/signaletique/show.html.twig', array(
            'signaletique' => $signaletique,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing signaletique entity.
     *
     * @Route("/{id}/edit", name="signaletique_edit", methods={"GET","POST"})
     */
    public function editAction(Request $request, Signaletique $signaletique)
    {
        $deleteForm = $this->createDeleteForm($signaletique);
        $editForm = $this->createForm('AppBundle\Form\SignaletiqueType', $signaletique);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('signaletique_edit', array('id' => $signaletique->getId()));
        }

        return $this->render('@App/signaletique/edit.html.twig', array(
            'signaletique' => $signaletique,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a signaletique entity.
     *
     * @Route("/{id}", name="signaletique_delete", methods={"DELETE"})
     */
    public function deleteAction(Request $request, Signaletique $signaletique)
    {
        $form = $this->createDeleteForm($signaletique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($signaletique);
            $em->flush();
        }

        return $this->redirectToRoute('signaletique_index');
    }

    /**
     * Creates a form to delete a signaletique entity.
     *
     * @param Signaletique $signaletique The signaletique entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Signaletique $signaletique)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('signaletique_delete', array('id' => $signaletique->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
