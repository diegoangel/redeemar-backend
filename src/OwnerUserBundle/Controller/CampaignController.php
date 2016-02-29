<?php

namespace OwnerUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Redeemar\Entity\Campaign;
use Redeemar\Entity\CampaignRepository;
use OwnerUserBundle\Form\CampaignType;

/**
 * Campaign controller.
 *
 * @Route("/offer")
 */
class CampaignController extends Controller
{
    /**
     * Lists all Campaign entities.
     *
     * @Route("/", name="owner_campaign_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $datatable = $this->get('app.datatable.offer');
        $datatable->buildDatatable();

        return $this->render('OwnerUserBundle:Campaign:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/results", name="owner_campaign_results")
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
     * Creates a new Campaign entity.
     *
     * @Route("/new", name="owner_campaign_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $offer = new Campaign();
        $form = $this->createForm('OwnerUserBundle\Form\CampaignType', $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('owner_campaign_show', array('id' => $offer->getId()));
        }

        return $this->render('OwnerUserBundle:Campaign:new.html.twig', array(
            'offer' => $offer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Campaign entity.
     *
     * @Route("/{id}", name="owner_campaign_show", options={"expose"=true})
     * @Method("GET")
     */
    public function showAction(Campaign $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);

        return $this->render('OwnerUserBundle:Campaign:show.html.twig', array(
            'offer' => $offer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Campaign entity.
     *
     * @Route("/{id}/edit", name="owner_campaign_edit", options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Campaign $offer)
    {
        $deleteForm = $this->createDeleteForm($offer);
        $editForm = $this->createForm('OwnerUserBundle\Form\CampaignType', $offer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offer);
            $em->flush();

            return $this->redirectToRoute('owner_campaign_edit', array('id' => $offer->getId()));
        }

        return $this->render('OwnerUserBundle:Campaign:edit.html.twig', array(
            'offer' => $offer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Campaign entity.
     *
     * @Route("/{id}", name="owner_campaign_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Campaign $offer)
    {
        $form = $this->createDeleteForm($offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offer);
            $em->flush();
        }

        return $this->redirectToRoute('owner_campaign_index');
    }

    /**
     * Creates a form to delete a Campaign entity.
     *
     * @param Campaign $offer The Campaign entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Campaign $offer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('owner_campaign_delete', array('id' => $offer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
