<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

class ServiceSpecificationResourceFactory
{
    public function __invoke($services)
    {
        return new ServiceSpecificationResource($services);
    }
}
