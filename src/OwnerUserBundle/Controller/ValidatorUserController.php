<?php

namespace OwnerUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Redeemar\Entity\ValidatorUser;
use OwnerUserBundle\Form\ValidatorUserType;

/**
 * ValidatorUser controller.
 *
 * @Route("/validatoruser")
 */
class ValidatorUserController extends Controller
{
    /**
     * Lists all ValidatorUser entities.
     *
     * @Route("/", name="owner_validatoruser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $validatorUsers = $em->getRepository('OwnerUserBundle:ValidatorUser')->findAll();

        return $this->render('ValidatorUser:index.html.twig', array(
            'validatorUsers' => $validatorUsers,
        ));
    }

    /**
     * Creates a new ValidatorUser entity.
     *
     * @Route("/new", name="owner_validatoruser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $validatorUser = new ValidatorUser();
        $form = $this->createForm('OwnerUserBundle\Form\ValidatorUserType', $validatorUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($validatorUser);
            $em->flush();

            return $this->redirectToRoute('owner_validatoruser_show', array('id' => $validatoruser->getId()));
        }

        return $this->render('OwnerUserBundle:ValidatorUser:new.html.twig', array(
            'validatorUser' => $validatorUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ValidatorUser entity.
     *
     * @Route("/{id}", name="owner_validatoruser_show")
     * @Method("GET")
     */
    public function showAction(ValidatorUser $validatorUser)
    {
        $deleteForm = $this->createDeleteForm($validatorUser);

        return $this->render('OwnerUserBundle:ValidatorUser:show.html.twig', array(
            'validatorUser' => $validatorUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ValidatorUser entity.
     *
     * @Route("/{id}/edit", name="owner_validatoruser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ValidatorUser $validatorUser)
    {
        $deleteForm = $this->createDeleteForm($validatorUser);
        $editForm = $this->createForm('OwnerUserBundle\Form\ValidatorUserType', $validatorUser);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($validatorUser);
            $em->flush();

            return $this->redirectToRoute('owner_validatoruser_edit', array('id' => $validatorUser->getId()));
        }

        return $this->render('OwnerUserBundle:ValidatorUser:edit.html.twig', array(
            'validatorUser' => $validatorUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ValidatorUser entity.
     *
     * @Route("/{id}", name="owner_validatoruser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ValidatorUser $validatorUser)
    {
        $form = $this->createDeleteForm($validatorUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($validatorUser);
            $em->flush();
        }

        return $this->redirectToRoute('owner_validatoruser_index');
    }

    /**
     * Creates a form to delete a ValidatorUser entity.
     *
     * @param ValidatorUser $validatorUser The ValidatorUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ValidatorUser $validatorUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('owner_validatoruser_delete', array('id' => $validatorUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
