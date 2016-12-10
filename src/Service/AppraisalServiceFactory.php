<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 17:31
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;

class AppraisalServiceFactory
{
    public function __invoke(ServiceManager $services)
    {
        return new AppraisalService($services);
    }
}