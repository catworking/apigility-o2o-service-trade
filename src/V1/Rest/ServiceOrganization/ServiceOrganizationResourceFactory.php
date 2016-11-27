<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization;

class ServiceOrganizationResourceFactory
{
    public function __invoke($services)
    {
        return new ServiceOrganizationResource($services);
    }
}
