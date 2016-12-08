<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\V1\Rest\Organization\OrganizationEntity;
use ApigilityO2oServiceTrade\V1\Rest\Occupation\OccupationEntity;
use ApigilityUser\DoctrineEntity\User;
use ApigilityUser\V1\Rest\User\UserEntity;

class IndividualEntity extends ApigilityObjectStorageAwareEntity
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
     * @ManyToOne(targetEntity="Occupation", inversedBy="individuals")
     * @JoinColumn(name="occupation_id", referencedColumnName="id")
     */
    protected $occupation;

    protected $user;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
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

    public function setOrganization($organization)
    {
        $this->organization = $organization;
        return $this;
    }

    public function getOrganization()
    {
        return $this->hydrator->extract(new OrganizationEntity($this->organization, $this->serviceManager));
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    public function getOccupation()
    {
        return $this->hydrator->extract(new OccupationEntity($this->occupation));
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->hydrator->extract(new UserEntity($this->user, $this->serviceManager));
    }
}
