<?php

namespace InoveBase\Service;

use Doctrine\DBAL\Logging\SQLLogger;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogSQL implements SQLLogger, ServiceLocatorAwareInterface {

    protected $serviceLocator;
    private $dbPlatform;


    public function setPlatform(){
        
        if(is_null($this->dbPlatform)){
            $em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
            $this->dbPlatform = $em->getConnection()->getDatabasePlatform();
        }
        
        
    }

    public function startQuery($sql, array $params = null, array $types = null) {
           
        if (!empty($params)) {
            $this->setPlatform();
            foreach ($params as $key => $param) {
                
                if($param instanceof \DateTime){
                    $param = $param->format('Y-m-d H:i:s');
                }
                else if(is_array($param)){
                    $param = implode(",",$param);
                }

                $sql = join(var_export($param, true), explode('?', $sql, 2));
            }
        }
        
        $this->getServiceLocator()->get('LOG')->debug($sql . " ;" . PHP_EOL);
         
         
    }

    public function stopQuery() {
        
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

}
