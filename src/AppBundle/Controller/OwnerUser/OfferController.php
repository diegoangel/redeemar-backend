<?php

namespace AppBundle\Controller\OwnerUser;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Offer;
use AppBundle\Form\OfferType;

/**
 * Offer controller.
 *
 * @Route("/owner/offer")
 */
class OfferController extends Controller
{
    /**
     * Lists all Offer entities.
     *
     * @Route("/", name="owner_offer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // $em = $this->getDoctrine()->getManager();

        // $offers = $em->getRepository('AppBundle:Offer')->findAll();

        // return $this->render('offer/index.html.twig', array(
        //     'offers' => $offers,
        // ));
        $datatable = $this->get('app.datatable.offer');
        $datatable->buildDatatable();

        return $this->render('offer/index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/results", name="owner_offer_results")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.offer');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Offer entity.
     *
     * @Route("/new", name="owner_offer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $offer = new Offer();
        $form = $this->createForm('AppBundle\Form\OfferType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('offer_show', array('id' => $offer->getId()));
        }

        return $this->render('offer/new.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Offer entity.
     *
     * @Route("/{id}", name="owner_offer_show", options={"expose"=true})
     * @Method("GET")
     */
    public function showAction(Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);

        return $this->render('offer/show.html.twig', array(
            'offer' => $offer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Offer entity.
     *
     * @Route("/{id}/edit", name="owner_offer_edit", options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Offer $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);
        $editForm = $this->createForm('AppBundle\Form\OfferType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('offer_edit', array('id' => $offer->getId()));
        }

        return $this->render('offer/edit.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Offer entity.
     *
     * @Route("/{id}", name="owner_offer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Offer $offer)
    {
        $form = $this->createDeleteForm($offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }

        return $this->redirectToRoute('offer_index');
    }

    /**
     * Creates a form to delete a Offer entity.
     *
     * @param Offer $offer The Offer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offer $offer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_delete', array('id' => $offer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
