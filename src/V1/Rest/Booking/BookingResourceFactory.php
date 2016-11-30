<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

class BookingResourceFactory
{
    public function __invoke($services)
    {
        return new BookingResource($services);
    }
}
