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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ManyToOne(targetEntity="OrganizationType", inversedBy="organizations")
     * @JoinColumn(name="organization_type_id", referencedColumnName="id")
     */
    protected $organizationType;

    /**
     * 机构能提供的标准化服务
     *
     * @ManyToMany(targetEntity="Service", inversedBy="providerOrganizations")
     * @JoinTable(name="apigilityo2oservicetrade_organizations_has_services")
     */
    protected $provideServices;

    /**
     * @OneToMany(targetEntity="Service", mappedBy="organization")
     */
    protected $ownServices;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->ownServices = new ArrayCollection();
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

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setOrganizationType($organization_type)
    {
        $this->organizationType = $organization_type;
        return $this;
    }

    public function getOrganizationType()
    {
        return $this->organizationType;
    }

    public function addOwnServices(Service $service)
    {
        $this->ownServices[] = $service;
        return $this;
    }

    public function addProvideService(Service $service)
    {
        $this->provideServices[] = $service;
        return $this;
    }
}