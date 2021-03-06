<?php
/**
 * 服务分类
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/23
 * Time: 15:44
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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ServiceCategory
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_service_category")
 */
class ServiceCategory
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 分类名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @OneToMany(targetEntity="ServiceCategory", mappedBy="parent")
     */
    protected $children;

    /**
     * @ManyToOne(targetEntity="ServiceCategory", inversedBy="children")
     * @JoinColumn(name="service_category_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ManyToMany(targetEntity="Service", mappedBy="categories")
     */
    protected $services;

    public function __construct() {
        $this->children = new ArrayCollection();
        $this->services = new ArrayCollection();
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

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }
}