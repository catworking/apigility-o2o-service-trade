<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

use ApigilityBlog\V1\Rest\Article\ArticleEntity;
use ApigilityCatworkFoundation\Base\ApigilityObjectStorageAwareEntity;
use ApigilityO2oServiceTrade\V1\Rest\Individual\IndividualEntity;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class PublishEntity extends ApigilityObjectStorageAwareEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 关联的服务个体
     *
     * @ManyToOne(targetEntity="Individual", inversedBy="publishes")
     * @JoinColumn(name="individual_id", referencedColumnName="id")
     */
    protected $individual;

    /**
     * 关联的文章
     *
     * @ManyToOne(targetEntity="ApigilityBlog\DoctrineEntity\Article")
     * @JoinColumn(name="article_id", referencedColumnName="id")
     */
    protected $article;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        if (empty($this->individual)) return $this->individual;
        else return $this->hydrator->extract(new IndividualEntity($this->individual, $this->serviceManager));
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
}
