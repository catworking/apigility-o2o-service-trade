<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class IndividualCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new IndividualEntity($item));
        }
        return $collection;
    }
}
