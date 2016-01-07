<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 07.01.16
 * Time: 19:08
 */

namespace AppBundle\Controller\api;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

class FaktumController extends FOSRestController
{
    public function getFaktumsAction($id){
        $faktums = $this->container->get('stabam.person.handler')->getFaktums($id);

        $view = View::create()
            ->setData(array('data' => $faktums));

        return $this->handleView($view);
    }
}