<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Occupation;

use ApigilityCatworkFoundation\Base\ApigilityCollection;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class OccupationCollection extends ApigilityCollection
{
    protected $itemType = OccupationEntity::class;
}
