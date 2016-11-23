<?php
/**
 * 提供服务的机构
 *
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 14:59
 */
namespace ApigilityO2oServiceTrade\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Class Organization
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_organization")
 */
class Organization
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 机构名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * 机构描述
     *
     * @Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * 机构图片
     *
     * @Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * 机构类型
     *
     * @ManyToOne(targetEntity="OrganizationType")
     * @JoinColumn(name="organization_type_id", referencedColumnName="id")
     */
    protected $organizationType;

    /**
     * 机构能提供的标准化服务
     *
     * @ManyToMany(targetEntity="Service")
     * @JoinTable(name="apigilityo2oservicetrade_organizations_has_services",
     *      joinColumns={@JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="service_id", referencedColumnName="id")}
     *      )
     */
    protected $services;
}