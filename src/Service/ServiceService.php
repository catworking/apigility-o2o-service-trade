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
     * @param $service_id
     * @return mixed
     * @throws Exception\ServiceNotExistException
     */
    public function getService($service_id)
    {
        $service = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Service', $service_id);
        if (empty($service)) throw new Exception\ServiceNotExistException();

        return $service;
    }

    /**
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
     * @param null $service_id
     * @return DoctrinePaginatorAdapter
     */
    public function getServiceCategorise($service_id = null)
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
}