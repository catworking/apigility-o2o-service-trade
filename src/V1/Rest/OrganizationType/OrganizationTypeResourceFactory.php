<?php
namespace ApigilityO2oServiceTrade\V1\Rest\OrganizationType;

class OrganizationTypeResourceFactory
{
    public function __invoke($services)
    {
        return new OrganizationTypeResource($services);
    }
}
