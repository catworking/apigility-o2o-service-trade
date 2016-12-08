<?php
namespace ApigilityO2oServiceTrade\V1\Rest\OrganizationType;

use ApigilityCatworkFoundation\Base\ApigilityEntity;

class OrganizationTypeEntity extends ApigilityEntity
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
