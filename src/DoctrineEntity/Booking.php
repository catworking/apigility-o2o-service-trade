<?php
/**
 * 服务预订数据
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:49
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
use ApigilityUser\DoctrineEntity\User;
use ApigilityOrder\DoctrineEntity\Order;

/**
 * Class Booking
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_booking")
 */
class Booking
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 预订表单的序列化数据
     *
     * @Column(type="text", nullable=true)
     */
    protected $booking_data;

    /**
     * 预订的用户
     *
     * @ManyToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 关联的订单
     *
     * @ManyToOne(targetEntity="ApigilityOrder\DoctrineEntity\Order")
     * @JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * 所购买服务的服务
     *
     * @ManyToOne(targetEntity="Service")
     * @JoinColumn(name="service_id", referencedColumnName="id")
     */
    protected $service;

    /**
     * 提供所购买服务的服务个体
     *
     * @ManyToOne(targetEntity="Individual")
     * @JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    /**
     * 提供所购买服务的机构
     *
     * @ManyToOne(targetEntity="Organization")
     * @JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * 评价
     *
     * @OneToOne(targetEntity="Appraisal", mappedBy="booking")
     */
    protected $appraisal;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBookingData($booking_data)
    {
        $this->booking_data = $booking_data;
        return $this;
    }

    public function getBookingData()
    {
        return $this->booking_data;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
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

    public function setAppraisal($appraisal)
    {
        $this->appraisal = $appraisal;
        return $this;
    }

    public function getAppraisal()
    {
        return $this->appraisal;
    }

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        return $this->individual;
    }

    public function setOrganization($organization)
    {
        $this->organization = $organization;
        return $this;
    }

    public function getOrganization()
    {
        return $this->organization;
    }
}