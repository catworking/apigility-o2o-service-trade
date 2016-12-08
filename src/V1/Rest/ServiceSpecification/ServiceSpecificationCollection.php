<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class ServiceSpecificationCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = ServiceSpecificationEntity::class;
}
