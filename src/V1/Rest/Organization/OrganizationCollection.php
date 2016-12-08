<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Organization;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class OrganizationCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = OrganizationEntity::class;
}
