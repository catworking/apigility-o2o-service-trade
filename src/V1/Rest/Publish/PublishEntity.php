<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

use ApigilityBlog\V1\Rest\Article\ArticleEntity;
use ApigilityO2oServiceTrade\V1\Rest\Individual\IndividualEntity;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;

class PublishEntity
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

    private $hy;

    public function __construct(\ApigilityO2oServiceTrade\DoctrineEntity\Publish $publish)
    {
        $this->hy = new ClassMethodsHydrator();
        $this->hy->hydrate($this->hy->extract($publish), $this);
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

    public function setIndividual($individual)
    {
        $this->individual = $individual;
        return $this;
    }

    public function getIndividual()
    {
        return $this->hy->extract(new IndividualEntity($this->individual));
    }

    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    public function getArticle()
    {
        return $this->hy->extract(new ArticleEntity($this->article));
    }
}
