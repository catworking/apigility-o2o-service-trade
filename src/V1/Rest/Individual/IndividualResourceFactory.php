<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

class IndividualResourceFactory
{
    public function __invoke($services)
    {
        return new IndividualResource($services);
    }
}
