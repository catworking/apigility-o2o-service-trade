<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceCategory;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class ServiceCategoryEntity
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

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\ServiceCategory $category)
    {
        $hy = new ClassMethodsHydrator();
        $hy->hydrate($hy->extract($category), $this);
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
}
