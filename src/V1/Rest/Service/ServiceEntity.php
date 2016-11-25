<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Service;

use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class ServiceEntity
{
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

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\Service $service)
    {
        $hy = new ClassMethodsHydrator();
        $hy->hydrate($hy->extract($service), $this);
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
}
