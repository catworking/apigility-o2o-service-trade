<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 16:02
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IndividualService
{
    protected $classMethodsHydrator;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取个体对象
     *
     * @param $individual_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\Individual
     * @throws \Exception
     */
    public function getIndividual($individual_id)
    {
        $individual = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Individual', $individual_id);
        if (empty($individual)) throw new \Exception(404, '找不到该个体');

        return $individual;
    }

    /**
     * 获取个体对象列表
     *
     * @return DoctrinePaginatorAdapter
     */
    public function getIndividuals($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('i')->from('ApigilityO2oServiceTrade\DoctrineEntity\Individual', 'i');

        if (isset($params->service_id)) {
            $qb->innerJoin('i.services', 's')
                ->where('s.id = :service_id')
                ->setParameter('service_id', $params->service_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}