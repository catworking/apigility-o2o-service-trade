<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceCategory;

class ServiceCategoryResourceFactory
{
    public function __invoke($services)
    {
        return new ServiceCategoryResource($services);
    }
}
