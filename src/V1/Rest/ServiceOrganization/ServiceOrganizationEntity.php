<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use ApigilityO2oServiceTrade\DoctrineEntity\Organization;

class ServiceOrganizationEntity
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

    public function __construct(Organization $organization)
    {
        $hy = new ClassMethodsHydrator();
        $hy->hydrate($hy->extract($organization), $this);
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
}
