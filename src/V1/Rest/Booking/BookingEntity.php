<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity;
use ApigilityOrder\V1\Rest\Order\OrderEntity;
use ApigilityUser\V1\Rest\User\UserEntity;

class BookingEntity extends ApigilityObjectStorageAwareEntity
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
     * 所属的服务
     *
     * @ManyToOne(targetEntity="Service")
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
        return $this->hydrator->extract(new UserEntity($this->user, $this->serviceManager));
    }

    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->hydrator->extract(new OrderEntity($this->order, $this->serviceManager));
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getService()
    {
        if (empty($this->service)) return $this->service;
        else return $this->hydrator->extract(new ServiceEntity($this->service, $this->serviceManager));
    }
}
