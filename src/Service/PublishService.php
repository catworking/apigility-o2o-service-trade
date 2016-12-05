<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/5
 * Time: 15:11
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityO2oServiceTrade\DoctrineEntity;
use ApigilityOrder\DoctrineEntity\Order;
use ApigilityOrder\DoctrineEntity\OrderDetail;

class PublishService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityBlog\Service\CategoryService
     */
    protected $articleCategoryService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->articleCategoryService = $services->get('ApigilityBlog\Service\CategoryService');
    }

    /**
     * 获取一个报道
     *
     * @param $publish_id
     * @return DoctrineEntity\Publish
     * @throws \Exception
     */
    public function getPublish($publish_id)
    {
        $publish = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Publish', $publish_id);
        if (empty($publish)) throw new \Exception(404, '报道不存在');

        return $publish;
    }

    /**
     * 获取报道列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     * @internal param $category_id
     */
    public function getPublishes($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('p')->from('ApigilityO2oServiceTrade\DoctrineEntity\Publish', 'p');

        $where = null;
        if (isset($params->category_id)) {
            $qb->innerJoin('p.article', 'a');
            $qb->innerJoin('a.categories', 'c');
            if (!empty($where)) $where .= ' AND ';
            $where = 'c.id = :category_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->category_id)) $qb->setParameter('category_id', $params->category_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}