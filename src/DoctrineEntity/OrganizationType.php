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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * 关联到此类型的机构
     *
     * @OneToMany(targetEntity="Organization", mappedBy="organizationType")
     */
    protected $organizations;

    public function __construct()
    {
        $this->organizations = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }
}