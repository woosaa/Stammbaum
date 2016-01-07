<?php

namespace AppBundle\Handler;

use AppBundle\Form\PersonType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class PersonFormHandler
{

    private $router;
    private $formFactory;
    private $personHandler;

    public function __construct($formFactory, $router, $personHandler)
    {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->personHandler = $personHandler;
    }

    public function buildForm(Request $request,$entity, $redirectTo){

        $form = $this->formFactory
            ->create(PersonType::class, $entity, array(
            'action' => $this->router->generate('person_create'),
            'method' => $request->getMethod()
        ));

        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->personHandler->savePerson($entity);
            return new RedirectResponse($this->router->generate($redirectTo, array()), '302');
        }

        return $form;
    }
}