<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/6
 * Time: 15:04
 */
namespace ApigilityO2oServiceTrade;

use ApigilityUser\Service\IdentityService;
use ApigilityUser\Service\UserService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;

class IndividualListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    private $services;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(UserService::EVENT_USER_CREATED, [$this, 'createIndividual'], $priority);
    }

    public function createIndividual(EventInterface $e)
    {
        $params = $e->getParams();

        // 创建个体记录
        if ($params['user']->getType() == 'individual') {
            $individualService = $this->services->get('ApigilityO2oServiceTrade\Service\IndividualService');
            $individualService->createIndividual('{}',$params['user']);
        }
    }
}