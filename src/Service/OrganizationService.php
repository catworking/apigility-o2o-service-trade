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

class OrganizationService
{
    protected $classMethodsHydrator;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取一个机构对象
     *
     * @param $occupation_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\Organization
     * @throws \Exception
     */
    public function getOrganization($organization_id)
    {
        $organization = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Organization', $organization_id);
        if (empty($organization)) throw new \Exception(404, '找不到该机构');

        return $organization;
    }

    /**
     * 获取一个机构对象列表
     *
     * @return DoctrinePaginatorAdapter
     */
    public function getOrganizations($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('o')->from('ApigilityO2oServiceTrade\DoctrineEntity\Organization', 'o');

        if (isset($params->service_id)) {
            $qb->innerJoin('o.services', 'os')
                ->where('os.id = :service_id')
                ->setParameter('service_id', $params->service_id);

        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}