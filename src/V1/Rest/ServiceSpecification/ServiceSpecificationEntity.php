<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use ApigilityO2oServiceTrade\DoctrineEntity\ServiceSpecification;

class ServiceSpecificationEntity
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

    public function __construct(ServiceSpecification $specification)
    {
        $hy = new ClassMethodsHydrator();
        $hy->hydrate($hy->extract($specification), $this);
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
}
