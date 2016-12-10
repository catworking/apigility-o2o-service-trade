<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Appraisal;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareCollection;

class AppraisalCollection extends ApigilityObjectStorageAwareCollection
{
    protected $itemType = AppraisalEntity::class;
}
