<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Occupation;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class OccupationCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new OccupationEntity($item));
        }
        return $collection;
    }
}
