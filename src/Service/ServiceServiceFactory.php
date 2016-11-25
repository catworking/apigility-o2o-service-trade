<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/25
 * Time: 11:58
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class ServiceServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new ServiceService($services);
    }
}