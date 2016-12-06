<?php
namespace ApigilityO2oServiceTrade;

use Zend\EventManager\EventInterface as Event;
use Zend\Mvc\MvcEvent;
use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Config\Config;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        $doctrine_config = new Config(include __DIR__ . '/config/doctrine.config.php');
        $service_config = new Config(include __DIR__ . '/config/service.config.php');
        $manual_config = new Config(include __DIR__ . '/config/manual.config.php');

        $module_config = new Config(include __DIR__ . '/config/module.config.php');
        $module_config->merge($doctrine_config);
        $module_config->merge($service_config);
        $module_config->merge($manual_config);

        return $module_config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

    public function onBootstrap(MvcEvent $e)
    {
        if ($e->getName() == MvcEvent::EVENT_BOOTSTRAP) {
            $application = $e->getApplication();
            $services    = $application->getServiceManager();

            $application->getEventManager()->attach(MvcEvent::EVENT_ROUTE, function () use ($services){
                $events = $services->get('ApigilityUser\Service\UserService')->getEventManager();

                $individual_listener = new IndividualListener($services);
                $individual_listener->attach($events);
            });
        }
    }
}
