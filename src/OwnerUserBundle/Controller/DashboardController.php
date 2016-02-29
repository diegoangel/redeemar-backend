<?php

namespace OwnerUserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Redeemar\Entity\Offer;
use Redeemar\Entity\OfferRepository;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="owner_dashboard")
     */
    public function indexAction(Request $request)
    {      
        $datatable = $this->get('app.datatable.dashboard');
        $datatable->buildDatatable();

        return $this->render('OwnerUserBundle:Dashboard:index.html.twig', array(
            'datatable' => $datatable,
        ));        
    }
    
    /**
     * @Route("/results", name="owner_dashboard_results")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexResultsAction()
    {
        $datatable = $this->get('app.datatable.dashboard');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        return $query->getResponse();
    }    
}
