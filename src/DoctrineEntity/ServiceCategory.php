<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:44
 */
namespace ApigilityO2oServiceTrade\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class ServiceCategory
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_service_category")
 */
class ServiceCategory
{
    protected $id;
    protected $name;
}