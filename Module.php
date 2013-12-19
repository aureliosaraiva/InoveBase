<?php
namespace InoveBase;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'InoveBase\Service\LogSQL' => function ($sm) {
                    $log =  new Service\LogSQL();
                    $log->setServiceLocator($sm);
                    return $log;
                },
                'Log' => function ($sm) {
                    $log =  new Service\Log();
                    return $log;
                },
            ),
        );
    }
}
