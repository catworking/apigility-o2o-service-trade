<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 17:30
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
 * Class Appraisal
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_appraisal")
 */
class Appraisal
{
    const STATUS_NONE = 1;     // 未审核
    const STATUS_ENABLE = 2;   // 允许
    const STATUS_DISABLE = 3;  // 禁止

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 评价的内容
     *
     * @OneToOne(targetEntity="ApigilityBlog\DoctrineEntity\Article")
     * @JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    /**
     * 评价时间
     *
     * @Column(type="datetime", nullable=false)
     */
    protected $create_time;

    /**
     * 状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $status;

    /**
     * 写评价的用户
     *
     * @ManyToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 评价目标：预订单
     *
     * @OneToOne(targetEntity="Booking", inversedBy="appraisal")
     * @JoinColumn(name="booking_id", referencedColumnName="id")
     */
    protected $booking;

    /**
     * 评价目标：服务
     *
     * @ManyToOne(targetEntity="Service", inversedBy="appraisals")
     * @JoinColumn(name="service_id", referencedColumnName="id")
     */
    protected $service;

    /**
     * 评价目标：个体
     *
     * @ManyToOne(targetEntity="Individual", inversedBy="appraisals")
     * @JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    public function getCreateTime()
    {
        return $this->create_time;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
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

    public function setBooking($booking)
    {
        $this->booking = $booking;
        return $this;
    }

    public function getBooking()
    {
        return $this->booking;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getService()
    {
        return $this->service;
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
}