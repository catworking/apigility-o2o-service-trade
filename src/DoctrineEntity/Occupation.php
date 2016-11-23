<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:12
 */
namespace ApigilityO2oServiceTrade\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * 职业表
 *
 * Class Occupation
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_occupation")
 */
class Occupation
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 职业名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;
}