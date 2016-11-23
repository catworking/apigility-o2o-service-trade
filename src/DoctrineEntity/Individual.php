<?php
/**
 * 提供服务的个体
 *
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
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Class Individual
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_individual")
 */
class Individual
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 机构描述
     *
     * @Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * 个体所属机构
     *
     * @ManyToOne(targetEntity="Organization")
     * @JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * 个体的职业
     *
     * @ManyToOne(targetEntity="Occupation")
     * @JoinColumn(name="occupation_id", referencedColumnName="id")
     */
    protected $occupation;

    /**
     * 个体能提供的标准化服务
     *
     * @ManyToMany(targetEntity="Service")
     * @JoinTable(name="apigilityo2oservicetrade_individuals_has_services",
     *      joinColumns={@JoinColumn(name="individual_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="service_id", referencedColumnName="id")}
     *      )
     */
    protected $services;
}