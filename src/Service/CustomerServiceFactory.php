<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/7
 * Time: 16:31
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class CustomerServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new CustomerService($services);
    }
}