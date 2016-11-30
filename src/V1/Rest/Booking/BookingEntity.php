<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

use ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity;
use ApigilityOrder\V1\Rest\Order\OrderEntity;
use ApigilityUser\V1\Rest\User\UserEntity;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class BookingEntity
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

    private $hy;

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\Booking $booking)
    {

        $this->hy = new ClassMethodsHydrator();
        $this->hy->hydrate($this->hy->extract($booking), $this);
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
        return $this->hy->extract(new UserEntity($this->user));
    }

    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->hy->extract(new OrderEntity($this->order));
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getService()
    {
        return $this->hy->extract(new ServiceEntity($this->service));
    }
}
