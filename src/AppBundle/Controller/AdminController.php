<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Admin controller.
 *
 * @Route("/admin")
 * @Security("has_role('ROLE_ADMIN')")
 * 
 */
class AdminController extends Controller
{
    /**
     * Lists all Competition entities.
     *
     * @Route("/", name="admin_index")
     * @Method("GET")
     */
    public function indexAction()
    {
$request = Request::createFromGlobals();
dump( $request->getLocale());
        return $this->render('admin/index.html.twig', array(
        ));
    }
}
