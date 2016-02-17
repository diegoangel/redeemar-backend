<?php

namespace AppBundle\Controller\SystemAdmin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Offer;

/**
 * @Route("/system", name="system")
 */
class DashboardController extends Controller
{
    /**
     * @Route("/dashboard", name="system_dashboard")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $offers = $em->getRepository('AppBundle:Offer')->findAll();

        return $this->render('AppBundle:System:Dashboard/index.html.twig', array(
            'offers' => $offers,
        ));
    }
}
