<?php

namespace InoveBase\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceLocatorInterface; 


abstract class AbstractService {
    
    
    /**
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     *
     * @var EntityManager 
     */
    protected $entityManager = null;


    public function __construct(EntityManager $em, ServiceLocatorInterface $serviceLocator) {
        $this->entityManager = $em;
        $this->serviceLocator = $serviceLocator;
    }
    
    protected function getServiceLocator() {
        return $this->serviceLocator;
    }

    protected function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }
    
    public function getEntityManager() {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }


    



    
}