<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use ApigilityO2oServiceTrade\V1\Rest\Organization\OrganizationEntity;
use ApigilityO2oServiceTrade\V1\Rest\Occupation\OccupationEntity;
use ApigilityUser\DoctrineEntity\User;
use ApigilityUser\V1\Rest\User\UserEntity;

class IndividualEntity
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

    private $hy;

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\Individual $individual)
    {
        $this->hy = new ClassMethodsHydrator();
        $this->hy->hydrate($this->hy->extract($individual), $this);
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
        return $this->hy->extract(new OrganizationEntity($this->organization));
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    public function getOccupation()
    {
        return $this->hy->extract(new OccupationEntity($this->occupation));
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->hy->extract(new UserEntity($this->user));
    }
}
