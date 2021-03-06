<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use ApigilityO2oServiceTrade\DoctrineEntity\ServiceSpecification;

class ServiceSpecificationEntity extends ApigilityObjectStorageAwareEntity
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
     * 规格简介
     *
     * @Column(type="string", length=800, nullable=true)
     */
    protected $summary;

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
        return $this->renderUriToUrl($this->image);
    }

    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    public function getSummary()
    {
        return $this->summary;
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
}
