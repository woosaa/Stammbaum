<?php

namespace AppBundle\Controller\api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PersonController extends FOSRestController
{
    /** @ApiDoc(
     *     statusCodes={
     *         200="Returned when successful",
     *         403="Returned when the user is not authorized to say hello",
     *         404={
     *           "Returned when the user is not found",
     *           "Returned when something else is not found"
     *         }
     *     }
     * )
     */
    public function getPersonAction ($id)
    {
        $person = $this->container
            ->get('stabam.person.handler')
            ->getPerson($id);

        $view = View::create()
            ->setData(array('data' => $person));

        return $this->handleView($view);

    }

    public function getPersonsAction(){
        $persons = $this->container
            ->get('stabam.person.handler')
            ->getPersons();

        $view = View::create()
            ->setData(array('data' => $persons));

        return $this->handleView($view);
    }

    public function postPersonAction(Request $request){


        //return new View(, Response::HTTP_CREATED);
    }

    public function deletePersonAction(Request $request, $id){

    }
}