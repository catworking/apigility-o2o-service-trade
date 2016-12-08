<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class PublishCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = PublishEntity::class;
}
