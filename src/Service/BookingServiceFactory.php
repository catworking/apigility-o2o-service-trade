<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 9:48
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class BookingServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new BookingService($services);
    }
}