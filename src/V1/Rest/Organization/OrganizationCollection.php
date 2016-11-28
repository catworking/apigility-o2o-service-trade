<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Organization;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class OrganizationCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new OrganizationEntity($item));
        }
        return $collection;
    }
}
