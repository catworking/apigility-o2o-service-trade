<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 15:11
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class OccupationService
{
    protected $classMethodsHydrator;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取一个职业对象
     *
     * @param $occupation_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\Occupation
     * @throws \Exception
     */
    public function getOccupation($occupation_id)
    {
        $occupation = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Occupation', $occupation_id);
        if (empty($occupation)) throw new \Exception(404, '找不到该职业');

        return $occupation;
    }

    /**
     * 获取一个职业对象列表
     *
     * @return DoctrinePaginatorAdapter
     */
    public function getOccupations()
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('o')->from('ApigilityO2oServiceTrade\DoctrineEntity\Occupation', 'o');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}