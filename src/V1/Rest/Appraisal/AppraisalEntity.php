<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Appraisal;

use ApigilityBlog\V1\Rest\Article\ArticleEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\DoctrineEntity\Booking;
use ApigilityO2oServiceTrade\DoctrineEntity\Individual;
use ApigilityO2oServiceTrade\DoctrineEntity\Service;
use ApigilityO2oServiceTrade\V1\Rest\Booking\BookingEntity;
use ApigilityO2oServiceTrade\V1\Rest\Individual\IndividualEntity;
use ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity;
use ApigilityUser\DoctrineEntity\User;
use ApigilityUser\V1\Rest\User\UserEntity;

class AppraisalEntity extends ApigilityObjectStorageAwareEntity
{
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
        return $this->hydrator->extract(new ArticleEntity($this->article, $this->serviceManager));
    }

    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    public function getCreateTime()
    {
        if ($this->create_time instanceof \DateTime) return $this->create_time->getTimestamp();
        else return $this->create_time;
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
        if ($this->user instanceof User) return $this->hydrator->extract(new UserEntity($this->user, $this->serviceManager));
        else return $this->user;
    }

    public function setBooking($booking)
    {
        $this->booking = $booking;
        return $this;
    }

    public function getBooking()
    {
        if ($this->booking instanceof Booking) return $this->hydrator->extract(new BookingEntity($this->booking, $this->serviceManager));
        else return $this->booking;
    }

    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function getService()
    {
        if ($this->service instanceof Service) return $this->hydrator->extract(new ServiceEntity($this->service, $this->serviceManager));
        else return $this->service;
    }

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        if ($this->individual instanceof Individual) return $this->hydrator->extract(new IndividualEntity($this->individual, $this->serviceManager));
        else return $this->individual;
    }
}
