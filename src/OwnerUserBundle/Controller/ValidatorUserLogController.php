<?php

namespace OwnerUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Redeemar\Entity\ValidatorUserLog;
use OwnerUserBundle\Form\ValidatorUserLogType;

/**
 * ValidatorUserLog controller.
 *
 * @Route("/validatoruserlog")
 */
class ValidatorUserLogController extends Controller
{
    /**
     * Lists all ValidatorUserLog entities.
     *
     * @Route("/", name="owner_validatoruserlog_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $validatorUsers = $em->getRepository('OwnerUserBundle:ValidatorUserLog')->findAll();

        return $this->render('ValidatorUserLog:index.html.twig', array(
            'validatorUsers' => $validatorUsers,
        ));
    }

    /**
     * Creates a new ValidatorUserLog entity.
     *
     * @Route("/new", name="owner_validatoruserlog_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $validatorUser = new ValidatorUserLog();
        $form = $this->createForm('OwnerUserBundle\Form\ValidatorUserLogType', $validatorUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($validatorUser);
            $em->flush();

            return $this->redirectToRoute('owner_validatoruserlog_show', array('id' => $validatoruserlog->getId()));
        }

        return $this->render('OwnerUserBundle:ValidatorUserLog:new.html.twig', array(
            'validatorUser' => $validatorUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ValidatorUserLog entity.
     *
     * @Route("/{id}", name="owner_validatoruserlog_show")
     * @Method("GET")
     */
    public function showAction(ValidatorUserLog $validatorUser)
    {
        $deleteForm = $this->createDeleteForm($validatorUser);

        return $this->render('OwnerUserBundle:ValidatorUserLog:show.html.twig', array(
            'validatorUser' => $validatorUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ValidatorUserLog entity.
     *
     * @Route("/{id}/edit", name="owner_validatoruserlog_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ValidatorUserLog $validatorUser)
    {
        $deleteForm = $this->createDeleteForm($validatorUser);
        $editForm = $this->createForm('OwnerUserBundle\Form\ValidatorUserLogType', $validatorUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($validatorUser);
            $em->flush();

            return $this->redirectToRoute('owner_validatoruserlog_edit', array('id' => $validatorUser->getId()));
        }

        return $this->render('OwnerUserBundle:ValidatorUserLog:edit.html.twig', array(
            'validatorUser' => $validatorUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ValidatorUserLog entity.
     *
     * @Route("/{id}", name="owner_validatoruserlog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ValidatorUserLog $validatorUser)
    {
        $form = $this->createDeleteForm($validatorUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($validatorUser);
            $em->flush();
        }

        return $this->redirectToRoute('owner_validatoruserlog_index');
    }

    /**
     * Creates a form to delete a ValidatorUserLog entity.
     *
     * @param ValidatorUserLog $validatorUser The ValidatorUserLog entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ValidatorUserLog $validatorUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('owner_validatoruserlog_delete', array('id' => $validatorUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
