<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Organization;

class OrganizationResourceFactory
{
    public function __invoke($services)
    {
        return new OrganizationResource($services);
    }
}
