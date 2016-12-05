<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 14:19
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
use ApigilityUser\DoctrineEntity\User;
use ApigilityOrder\DoctrineEntity\Order;

/**
 * Class Publish
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityo2oservicetrade_publish")
 */
class Publish
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
        return $this->individual;
    }

    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    public function getArticle()
    {
        return $this->article;
    }
}