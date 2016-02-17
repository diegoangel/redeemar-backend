<?php

namespace AppBundle\Controller\Owner;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;

/**
 * @Route("/owner", name="owner")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="owner_dashboard")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('AppBundle:Offer')->findAll();

        return $this->render('AppBundle:Owner:Dashboard/index.html.twig', array(
            'offers' => $offers,
        ));
    }
}
