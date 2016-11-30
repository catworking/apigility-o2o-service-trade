<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

use ApigilityO2oServiceTrade\DoctrineEntity\Booking;
use Zend\Paginator\Paginator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class BookingCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new BookingEntity($item));
        }
        return $collection;
    }
}
