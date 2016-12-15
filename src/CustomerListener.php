<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/15
 * Time: 11:37
 */
namespace ApigilityO2oServiceTrade;

use ApigilityUser\Service\IdentityService;
use ApigilityUser\Service\UserService;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;

class CustomerListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    private $services;

    /**
     * @var \ApigilityUser\Service\IdentityService
     */
    private $identityService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(UserService::EVENT_USER_CREATED, [$this, 'createCustomer'], $priority);
    }

    public function createCustomer(EventInterface $e)
    {
        $params = $e->getParams();
        $booking = $params['booking'];
        $

        // 创建客户记录
        $this->identityService = $this->services->get('ApigilityUser\Service\IdentityService');
        $identity = $this->identityService->getIdentity($params['user']->getId());
        if ($identity->getType() == 'individual') {
            $individualService = $this->services->get('ApigilityO2oServiceTrade\Service\IndividualService');
            $individualService->createIndividual('{}',$params['user']);
        }
    }
}