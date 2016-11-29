<?php
/**
 * 服务
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/22
 * Time: 12:00
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

/**
 * Class Service
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_service")
 */
class Service
{
    const TYPE_STANDARD = 1;
    const TYPE_NONSTANDARD = 2;

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 服务类型
     *
     * @Column(type="smallint", nullable=true)
     */
    protected $type;

    /**
     * 服务的标题
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $title;

    /**
     * 服务的主题图片
     *
     * @Column(type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * 服务的描述
     *
     * @Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * 服务所属机构
     *
     * @ManyToOne(targetEntity="Organization", inversedBy="ownServices")
     * @JoinColumn(name="organization_id", referencedColumnName="id")
     */
    protected $organization;

    /**
     * 服务所属机构
     *
     * @ManyToOne(targetEntity="Individual", inversedBy="ownServices")
     * @JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    /**
     * @ManyToMany(targetEntity="Organization", mappedBy="provideServices")
     */
    protected $providerOrganizations;

    /**
     * @ManyToMany(targetEntity="Individual", mappedBy="provideServices")
     */
    protected $providerIndividuals;

    /**
     * 服务所属于的分类（可多选）
     *
     * @ManyToMany(targetEntity="ServiceCategory", inversedBy="services")
     * @JoinTable(name="apigilityo2oservicetrade_services_belongs_service_categories")
     */
    protected $categories;

    /**
     * 服务的规格
     *
     * @OneToMany(targetEntity="ServiceSpecification", mappedBy="service")
     */
    protected $specifications;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->specifications = new ArrayCollection();
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

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
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

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        return $this->individual;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getSpecifications()
    {
        return $this->specifications;
    }
}