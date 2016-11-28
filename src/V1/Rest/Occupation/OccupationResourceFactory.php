<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Occupation;

class OccupationResourceFactory
{
    public function __invoke($services)
    {
        return new OccupationResource($services);
    }
}
