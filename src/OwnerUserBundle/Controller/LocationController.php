<?php

namespace OwnerUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Redeemar\Entity\Location;
use OwnerUserBundle\Form\LocationType;

/**
 * Location controller.
 *
 * @Route("/location")
 */
class LocationController extends Controller
{
    /**
     * Lists all Location entities.
     *
     * @Route("/", name="owner_location_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $datatable = $this->get('owner.datatable.location');
        $datatable->buildDatatable();

        return $this->render('OwnerUserBundle:Location:index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * @Route("/results", name="owner_location_results")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('owner.datatable.location');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }

    /**
     * Creates a new Location entity.
     *
     * @Route("/new", name="owner_location_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm('OwnerUserBundle\Form\LocationType', $location, array(
            'action' => $this->generateUrl('owner_location_new')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $company = $this->getDoctrine()
                ->getRepository('Redeemar:Company')
                ->findAll();

            $location->setCompany($company[0]);

            $this->getCoordinates($location);

            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('owner_location_index');
        }

        return $this->render('OwnerUserBundle:Location:new.html.twig', array(
            'location' => $location,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a Location entity.
     *
     * @Route("/{id}", name="owner_location_show", options={"expose"=true})
     * @Method("GET")
     */
    public function showAction(Location $location)
    {
        $deleteForm = $this->createDeleteForm($location);

        return $this->render('OwnerUserBundle:Location:show.html.twig', array(
            'location' => $location,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Location entity.
     *
     * @Route("/{id}/edit", name="owner_location_edit", options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {

        $location = $this->getDoctrine()->getRepository('Redeemar:Location')->find($request->get('id'));
        $editForm = $this->createForm('OwnerUserBundle\Form\LocationType', $location, array(
            'action' => $this->generateUrl('owner_location_edit', array(
                'id'=> $location->getId()
            ))
        ));
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('owner_location_index');
        }

        return $this->render('OwnerUserBundle:Location:new.html.twig', array(
            'location' => $location,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Location entity.
     *
     * @Route("/{id}/delete", name="owner_location_delete", options={"expose"=true})
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
        $location = $this->getDoctrine()->getRepository('Redeemar:Location')->find($request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $em->remove($location);
        $em->flush();
        return $this->redirectToRoute('owner_location_index');
    }

    /**
     * Creates a form to delete a Location entity.
     *
     * @param Location $location The Location entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Location $location)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('owner_location_delete', array('id' => $location->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function getCoordinates(Location $location){
        $geocoder = $this->get('ivory_google_map.geocoder');
        $geoAdress = $geocoder->geocode($location->getAddress())->getResults();
        $coordinates = $geoAdress[0]->getGeometry()->getLocation();
        $location->setLatitude($coordinates->getLatitude());
        $location->setLongitude($coordinates->getLongitude());
    }
}
