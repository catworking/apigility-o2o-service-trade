<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class BookingCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = BookingEntity::class;
}
