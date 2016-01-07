<?php

namespace AppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpKernel\Exception;


class PersonHandler
{
    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    public function getPerson($id)
    {
        $entity = $this->repository->find($id);

        if(!$entity){
            throw new Exception\NotFoundHttpException("Person not found!");
        }

        return $entity;
    }

    public function getPersons(){
        return $this->repository->findAll();
    }

    public function newPerson(){
        return new $this->entityClass();
    }

    public function savePerson($entity){
        $this->om->persist($entity);
        $this->om->flush();
    }


    public function getFaktums($id){
        return $this->getPerson($id)->getFaktums();
    }

}