<?php
/**
 * 服务套餐（规格）
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:45
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

/**
 * Class ServiceSpecification
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_service_specification")
 */
class ServiceSpecification
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 规格名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * 规格图片
     *
     * @Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * 规格描述
     *
     * @Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * 价格
     *
     * @Column(type="decimal", precision=7, scale=2, nullable=true)
     */
    protected $price;

    /**
     * 规格所属的服务
     * @var Service
     * @ManyToOne(targetEntity="Service", inversedBy="specifications")
     * @JoinColumn(name="service_id", referencedColumnName="id")
     */
    protected $service;

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

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
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

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }
}