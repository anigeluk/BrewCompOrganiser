<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Competition;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $competition = $this->getDoctrine()
            ->getRepository('AppBundle:Competition')
            ->find(1);
        /* @var $competition Competition */

        if (!$competition) {
            throw $this->createNotFoundException(
                'Brew Competition Organiser has not been set up yet.'
            );
        }

        $registrationOpen = $competition->isWindowOpen($competition->getRegistrationOpen(), $competition->getRegistrationClose());
        return $this->render('home/index.html.twig', [
            'competition' => $competition,
            'registrationOpen' => $registrationOpen
        ]);
    }
}
