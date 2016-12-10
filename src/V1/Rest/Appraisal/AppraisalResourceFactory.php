<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Appraisal;

class AppraisalResourceFactory
{
    public function __invoke($services)
    {
        return new AppraisalResource($services);
    }
}
