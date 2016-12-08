<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Customer;

use ApigilityCatworkFoundation\Base\ApigilityEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\V1\Rest\Individual\IndividualEntity;
use ApigilityUser\V1\Rest\User\UserEntity;

class CustomerEntity extends ApigilityObjectStorageAwareEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 关联的服务个体
     *
     * @ManyToOne(targetEntity="Individual", inversedBy="customers")
     * @JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    /**
     * 关联的用户
     *
     * @ManyToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 客户备注
     *
     * @Column(type="string", length=800, nullable=true)
     */
    protected $remark;

    /**
     * 创建时间
     *
     * @Column(type="datetime", nullable=false)
     */
    protected $create_time;


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        return $this->hydrator->extract(new IndividualEntity($this->individual, $this->serviceManager));
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->hydrator->extract(new UserEntity($this->user, $this->serviceManager));
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        return $this;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setCreateTime(\DateTime $create_time)
    {
        $this->create_time = $create_time->getTimestamp();
        return $this;
    }

    public function getCreateTime()
    {
        return $this->create_time;
    }
}
