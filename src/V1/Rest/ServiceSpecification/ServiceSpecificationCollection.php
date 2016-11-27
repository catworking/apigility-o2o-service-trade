<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class ServiceSpecificationCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new ServiceSpecificationEntity($item));
        }
        return $collection;
    }
}
