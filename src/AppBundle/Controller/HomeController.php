<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        if (!$competition) {
            throw $this->createNotFoundException(
                'Brew Competition Organiser has not been set up yet.'
            );
        }
        return $this->render('home/index.html.twig', [
            'competition' => $competition,
        ]);
    }
}
