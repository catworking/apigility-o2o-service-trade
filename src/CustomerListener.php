<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/15
 * Time: 11:37
 */
namespace ApigilityO2oServiceTrade;

use ApigilityO2oServiceTrade\DoctrineEntity\Individual;
use ApigilityO2oServiceTrade\Service\BookingService;
use ApigilityUser\DoctrineEntity\User;
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
     * @var \ApigilityO2oServiceTrade\Service\CustomerService
     */
    private $customerService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(BookingService::EVENT_BOOKING_CREATED, [$this, 'createCustomer'], $priority);
    }

    public function createCustomer(EventInterface $e)
    {
        $params = $e->getParams();
        $booking = $params['booking'];

        $user = $booking->getUser();
        $individual = $booking->getIndividual();

        // 创建客户记录
        if ($user instanceof User && $individual instanceof Individual) {
            $this->customerService = $this->services->get('ApigilityO2oServiceTrade\Service\CustomerService');
            $this->customerService->createCustomer($user, $individual);
        }
    }
}