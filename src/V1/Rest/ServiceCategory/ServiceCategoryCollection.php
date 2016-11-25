<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceCategory;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class ServiceCategoryCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new ServiceCategoryEntity($item));
        }
        return $collection;
    }
}
