<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Service;

use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\V1\Rest\Organization\OrganizationEntity;
use ApigilityO2oServiceTrade\V1\Rest\Individual\IndividualEntity;
use ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryEntity;
use ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationEntity;

class ServiceEntity extends ApigilityObjectStorageAwareEntity
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

    protected $categories;
    protected $specifications;

    protected $organization;
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
        return $this->renderUriToUrl($this->image);
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

    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    public function getCategories()
    {
        return $this->getJsonValueFromDoctrineCollection($this->categories, ServiceCategoryEntity::class);
    }

    public function setSpecifications($specifications)
    {
        $this->specifications = $specifications;
        return $this;
    }

    public function getSpecifications()
    {
        return $this->getJsonValueFromDoctrineCollection($this->specifications, ServiceSpecificationEntity::class, $this->serviceManager);
    }

    public function setOrganization($organization)
    {
        $this->organization = $organization;
        return $this;
    }

    public function getOrganization()
    {
        if (empty($this->organization)) return $this->organization;
        else return $this->hydrator->extract(new OrganizationEntity($this->organization, $this->serviceManager));
    }

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        if (empty($this->individual)) return $this->individual;
        return $this->hydrator->extract(new IndividualEntity($this->individual, $this->serviceManager));
    }
}
