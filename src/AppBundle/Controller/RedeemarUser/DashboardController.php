<?php

namespace AppBundle\Controller\RedeemarUser;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;
use AppBundle\Entity\OfferRepository;

/**
 * @Route("/redeemar")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="redeemar_dashboard")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('AppBundle:Offer')->findAll();

        return $this->render('AppBundle:RedeemarUser:dashboard/index.html.twig', array(
            'offers' => $offers,
        ));
    }
}
