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

class OrganizationTypeService
{
    protected $classMethodsHydrator;
    protected $em;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
    }

    /**
     * 获取一个机构类型对象
     *
     * @param $occupation_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\OrganizationType
     * @throws \Exception
     */
    public function getOrganizationType($organization_type_id)
    {
        $organization_type = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\OrganizationType', $organization_type_id);
        if (empty($organization_type)) throw new \Exception(404, '找不到该机构类型');

        return $organization_type;
    }

    /**
     * 获取一个机构类型对象列表
     *
     * @return DoctrinePaginatorAdapter
     */
    public function getOrganizationTypes()
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('ot')->from('ApigilityO2oServiceTrade\DoctrineEntity\OrganizationType', 'ot');

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}