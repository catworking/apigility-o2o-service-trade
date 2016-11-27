<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class ServiceOrganizationCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new ServiceOrganizationEntity($item));
        }
        return $collection;
    }
}
