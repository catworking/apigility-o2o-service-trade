<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Occupation;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class OccupationEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 职业名称
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $name;

    private $hy;

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\Occupation $occupation)
    {
        $this->hy = new ClassMethodsHydrator();
        $this->hy->hydrate($this->hy->extract($occupation), $this);
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
