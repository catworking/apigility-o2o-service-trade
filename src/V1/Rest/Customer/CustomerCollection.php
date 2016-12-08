<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Customer;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class CustomerCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = CustomerEntity::class;
}
