<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 15:12
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class PublishServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new PublishService($services);
    }
}