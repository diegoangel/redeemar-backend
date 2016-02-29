<?php

namespace RedeemarUserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Redeemar\Entity\Offer;
use Redeemar\Entity\OfferRepository;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="redeemar_dashboard")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('Redeemar:Offer')->findAll();

        return $this->render('RedeemarUserBundle:Dashboard:index.html.twig', array(
            'offers' => $offers,
        ));
    }
}
