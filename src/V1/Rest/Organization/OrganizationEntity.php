<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Organization;

use ApigilityAddress\DoctrineEntity\Address;
use ApigilityAddress\V1\Rest\Address\AddressEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;

class OrganizationEntity extends ApigilityObjectStorageAwareEntity
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
     * 机构地址
     *
     * @ManyToOne(targetEntity="ApigilityAddress\Doctrine\Address")
     * @JoinColumn(name="address_id", referencedColumnName="id")
     */
    protected $address;

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
        return $this->renderUriToUrl($this->image);
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getAddress()
    {
        if ($this->address instanceof Address) return $this->hydrator->extract(new AddressEntity($this->address));
        else return $this->address;
    }
}
