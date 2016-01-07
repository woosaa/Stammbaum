<?php

namespace AppBundle\Controller\api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;



class PersonController extends FOSRestController
{
    public function getPersonAction ($id)
    {
        $person = $this->container
            ->get('stabam.person.handler')
            ->getPerson($id);

        $view = View::create()
            ->setData(array('Person' => $person));

        return $this->handleView($view);

    }
/*
    public function getPersonsAction(){
        $persons = $this->container
            ->get('stabam.person.handler')
            ->getPersons();
        return $persons;
   }*/
}