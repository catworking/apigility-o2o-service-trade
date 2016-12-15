<?php
/**
 * 提供服务的个体
 *
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:09
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
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;
use ApigilityUser\DoctrineEntity\User;

/**
 * Class Individual
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_individual")
 */
class Individual
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

    /**
     * 个体能提供的标准化服务
     *
     * @ManyToMany(targetEntity="Service", inversedBy="providerIndividuals")
     * @JoinTable(name="apigilityo2oservicetrade_individuals_has_services")
     */
    protected $provideServices;

    /**
     * 个体拥有的非标准服务
     *
     * @OneToMany(targetEntity="Service", mappedBy="individual")
     */
    protected $ownServices;

    /**
     * ApigilityUser组件的用户对象
     *
     * @OneToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 该个体的报道
     *
     * @OneToMany(targetEntity="Publish", mappedBy="individual")
     */
    protected $publishes;

    /**
     * 评价
     *
     * @OneToMany(targetEntity="Appraisal", mappedBy="individual")
     */
    protected $appraisals;

    /**
     * @OneToMany(targetEntity="Customer", mappedBy="individual")
     */
    protected $customers;

    /**
     * 收到的预订单
     *
     * @OneToMany(targetEntity="Booking", mappedBy="organization")
     */
    protected $bookings;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->ownServices = new ArrayCollection();
        $this->appraisals = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->bookings = new ArrayCollection();
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
        return $this->organization;
    }

    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
        return $this;
    }

    public function getOccupation()
    {
        return $this->occupation;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function addOwnService(Service $service)
    {
        $this->ownServices[] = $service;
        return $this;
    }

    public function addProvideService(Service $service)
    {
        $this->provideServices[] = $service;
        return $this;
    }

    public function addAppraisal($appraisal)
    {
        $this->appraisals[] = $appraisal;
        return $this;
    }

    public function setAppraisals($appraisals)
    {
        $this->appraisals = $appraisals;
        return $this;
    }

    public function getAppraisals()
    {
        return $this->appraisals;
    }

    public function setCustomers($customers)
    {
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers()
    {
        return $this->customers;
    }

    public function addCustomer($customer)
    {
        $this->customers[] = $customer;
        return $this;
    }

    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
        return $this;
    }

    public function getBookings()
    {
        return $this->bookings;
    }

    public function addBooking($booking)
    {
        $this->bookings[] = $booking;
        return $this;
    }
}