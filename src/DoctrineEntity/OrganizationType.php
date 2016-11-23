<?php
/**
 * 组织类型
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:01
 */
namespace ApigilityO2oServiceTrade\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Class OrganizationType
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_organization_type")
 */
class OrganizationType
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 类型名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;
}