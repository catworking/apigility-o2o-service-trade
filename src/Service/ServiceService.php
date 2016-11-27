<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/25
 * Time: 11:57
 */
namespace ApigilityO2oServiceTrade\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class ServiceService
{
    protected $classMethodsHydrator;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取一个服务对象
     *
     * @param $service_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\Service
     * @throws Exception\ServiceNotExistException
     */
    public function getService($service_id)
    {
        $service = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Service', $service_id);
        if (empty($service)) throw new Exception\ServiceNotExistException();

        return $service;
    }

    /**
     * 获取服务对象列表
     *
     * @param null $type
     * @param null $service_category_id
     * @return DoctrinePaginatorAdapter
     */
    public function getServices($type = null, $service_category_id = null)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('s')->from('ApigilityO2oServiceTrade\DoctrineEntity\Service', 's');

        $where = null;
        if (!empty($type)) {
            $where = 's.type = :type';
        }

        if (!empty($service_category_id)) {
            $qb->innerJoin('s.categories', 'sc');

            if (!empty($where)) $where .= ' AND ';
            $where .= 'sc.id = :service_category_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (!empty($type)) $qb->setParameter('type', $type);
            if (!empty($service_category_id)) $qb->setParameter('service_category_id', $service_category_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 获取服务的分类
     *
     * @param null $service_id
     * @return DoctrinePaginatorAdapter
     */
    public function getServiceCategories($service_id = null)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('sc')->from('ApigilityO2oServiceTrade\DoctrineEntity\ServiceCategory', 'sc');

        if (!empty($service_id)) {
            $qb->innerJoin('sc.services', 's')
                ->where('s.id = :service_id')
                ->setParameter('service_id', $service_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 获取服务的规格
     *
     * @param null $service_id
     * @return DoctrinePaginatorAdapter
     */
    public function getServiceSpecifications($service_id = null)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('ss')->from('ApigilityO2oServiceTrade\DoctrineEntity\ServiceSpecification', 'ss');

        if (!empty($service_id)) {
            $qb->innerJoin('ss.service', 's')
                ->where('s.id = :service_id')
                ->setParameter('service_id', $service_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 获取非标准服务的提供机构
     *
     * @param null $service_id
     * @return DoctrinePaginatorAdapter
     */
    public function getServiceOrganization($service_id = null)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('o')->from('ApigilityO2oServiceTrade\DoctrineEntity\Organization', 'o');

        if (!empty($service_id)) {
            $qb->join('o.ownServices', 'os')
                ->where('os.id = :service_id')
                ->setParameter('service_id', $service_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}