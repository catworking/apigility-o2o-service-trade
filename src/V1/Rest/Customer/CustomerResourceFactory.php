<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Customer;

class CustomerResourceFactory
{
    public function __invoke($services)
    {
        return new CustomerResource($services);
    }
}
