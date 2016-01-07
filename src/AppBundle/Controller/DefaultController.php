<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="check")
     */
    public function indexAction(Request $request)
    {
        $token = $this->get('security.token_storage')->getToken();

        if($token->isAuthenticated()){
            return new RedirectResponse($this->generateUrl('person'));
        }

        return new RedirectResponse($this->generateUrl('login'));

    }
}
