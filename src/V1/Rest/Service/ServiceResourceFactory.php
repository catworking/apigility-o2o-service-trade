<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Service;

class ServiceResourceFactory
{
    public function __invoke($services)
    {
        return new ServiceResource($services);
    }
}
