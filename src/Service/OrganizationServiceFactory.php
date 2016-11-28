<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 16:02
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class OrganizationServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new OrganizationService($services);
    }
}