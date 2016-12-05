<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class PublishCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new PublishEntity($item));
        }
        return $collection;
    }
}
