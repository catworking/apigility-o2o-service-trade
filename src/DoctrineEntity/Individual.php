<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:09
 */
namespace ApigilityO2oServiceTrade\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class Individual
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_individual")
 */
class Individual
{
    protected $id;
    protected $name;
    protected $avatar;
    protected $description;
    protected $organization_id;
    protected $occupation_id;
}