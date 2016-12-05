<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

class PublishResourceFactory
{
    public function __invoke($services)
    {
        return new PublishResource($services);
    }
}
