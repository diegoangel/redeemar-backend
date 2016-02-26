<?php

namespace AppBundle\Controller\OwnerUser;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Logo;
use AppBundle\Entity\LogoRepository;
use AppBundle\Form\LogoType;

/**
 * Logo controller.
 *
 * @Route("/owner/logo")
 */
class LogoController extends Controller
{
    /**
     * Lists all Logo entities.
     *
     * @Route("/", name="owner_logo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $logos = $em->getRepository('AppBundle:Logo')->findAll();

        return $this->render('logo/index.html.twig', array(
            'logos' => $logos,
        ));
    }

    /**
     * Creates a new Logo entity.
     *
     * @Route("/new", name="owner_logo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $logo = new Logo();
        $form = $this->createForm('AppBundle\Form\LogoType', $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();

            return $this->redirectToRoute('logo_show', array('id' => $logo->getId()));
        }

        return $this->render('logo/new.html.twig', array(
            'logo' => $logo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Logo entity.
     *
     * @Route("/{id}", name="owner_logo_show")
     * @Method("GET")
     */
    public function showAction(Logo $logo)
    {
        $deleteForm = $this->createDeleteForm($logo);

        return $this->render('logo/show.html.twig', array(
            'logo' => $logo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Logo entity.
     *
     * @Route("/{id}/edit", name="owner_logo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Logo $logo)
    {
        $deleteForm = $this->createDeleteForm($logo);
        $editForm = $this->createForm('AppBundle\Form\LogoType', $logo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();

            return $this->redirectToRoute('logo_edit', array('id' => $logo->getId()));
        }

        return $this->render('logo/edit.html.twig', array(
            'logo' => $logo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Logo entity.
     *
     * @Route("/{id}", name="owner_logo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Logo $logo)
    {
        $form = $this->createDeleteForm($logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($logo);
            $em->flush();
        }

        return $this->redirectToRoute('logo_index');
    }

    /**
     * Creates a form to delete a Logo entity.
     *
     * @param Logo $logo The Logo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Logo $logo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('logo_delete', array('id' => $logo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
