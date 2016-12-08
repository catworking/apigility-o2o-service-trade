<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class IndividualCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = IndividualEntity::class;
}
