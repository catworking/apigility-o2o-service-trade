<?php
namespace ApigilityO2oServiceTrade\V1\Rest\OrganizationType;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class OrganizationTypeCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new OrganizationTypeEntity($item));
        }
        return $collection;
    }
}
