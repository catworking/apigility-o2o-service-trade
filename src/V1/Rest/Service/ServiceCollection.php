<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Service;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class ServiceCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = ServiceEntity::class;
}
