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
     * @param $params
     * @return DoctrinePaginatorAdapter
     * @internal param null $type
     * @internal param null $service_category_id
     */
    public function getServices($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('s')->from('ApigilityO2oServiceTrade\DoctrineEntity\Service', 's');

        $where = null;
        if (isset($params->type)) {
            $where = 's.type = :type';
        }

        if (isset($params->owner_type)) {
            if (!empty($where)) $where .= ' AND ';
            switch ($params->owner_type) {
                case 'organization':
                    $where .= 's.organization IS NOT NULL';
                    break;
                case 'individual':
                    $where .= 's.individual IS NOT NULL';
                    break;
                default:
                    throw new \Exception('未知的owner_type', 500);
            }
        }

        if (isset($params->service_category_id)) {
            $qb->innerJoin('s.categories', 'sc');
            if (!empty($where)) $where .= ' AND ';
            $where .= '(sc.id = :service_category_id';
            $sub_ids = $this->getServiceCategoryChildrenIds($params->service_category_id, true);
            if (count($sub_ids) > 0) {
                $where .= ' OR sc.id IN ('.implode(',',$sub_ids) .')';
            }
            $where .= ')';
        }

        if (isset($params->owner_organization_id)) {
            $qb->innerJoin('s.organization', 'so');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'so.id = :owner_organization_id';
        }

        if (isset($params->provider_organization_id)) {
            $qb->innerJoin('s.providerOrganizations', 'spo');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'spo.id = :provider_organization_id';
        }

        if (isset($params->owner_individual_id)) {
            $qb->innerJoin('s.individual', 'si');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'si.id = :owner_individual_id';
        }

        if (isset($params->provider_individual_id)) {
            $qb->innerJoin('s.providerIndividuals', 'spi');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'spi.id = :provider_individual_id';
        }



        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->type)) $qb->setParameter('type', $params->type);
            if (isset($params->service_category_id)) $qb->setParameter('service_category_id', $params->service_category_id);
            if (isset($params->owner_organization_id)) $qb->setParameter('owner_organization_id', $params->owner_organization_id);
            if (isset($params->provider_organization_id)) $qb->setParameter('provider_organization_id', $params->provider_organization_id);
            if (isset($params->owner_individual_id)) $qb->setParameter('owner_individual_id', $params->owner_individual_id);
            if (isset($params->provider_individual_id)) $qb->setParameter('provider_individual_id', $params->provider_individual_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 获取服务的分类列表
     *
     * @param $params
     * @param bool $recursion
     * @return DoctrinePaginatorAdapter
     * @internal param null $service_id
     */
    public function getServiceCategories($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('sc')->from('ApigilityO2oServiceTrade\DoctrineEntity\ServiceCategory', 'sc');

        if (isset($params->service_category_id)) {
            $qb->innerJoin('sc.parent', 'p')
                ->where('p.id = :service_category_id')
                ->setParameter('service_category_id', $params->service_category_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 获取一个分类下的所有下级分类id，作为一个数组返回。如果指定$recursion为true，会递归处理所有子级层。
     *
     * @param null $service_category_id
     * @param bool $recursion
     * @return array
     */
    public function getServiceCategoryChildrenIds($service_category_id, $recursion = false)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('sc.id')->from('ApigilityO2oServiceTrade\DoctrineEntity\ServiceCategory', 'sc');

        if (!empty($service_category_id)) {
            $qb->innerJoin('sc.parent', 'p')
                ->where('p.id = :service_category_id')
                ->setParameter('service_category_id', $service_category_id);
        }

        $ids = $qb->getQuery()->getResult();

        $ids_data = array();
        foreach ($ids as $id) {
            $ids_data[] = $id['id'];
        }

        if ($recursion && count($ids_data) > 0) {
            $sub_ids_arrays = array();
            foreach ($ids_data as $id) {
                $sub_ids_arrays[] = $this->getServiceCategoryChildrenIds($id, $recursion);
            }

            foreach ($sub_ids_arrays as $sub_id_array) {
                $ids_data = array_merge($ids_data, $sub_id_array);
            }
        }

        return $ids_data;
    }

    /**
     * 获取服务的规格列表
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
     * 获取服务的规格
     *
     * @param $service_specification_id
     * @return \ApigilityO2oServiceTrade\DoctrineEntity\ServiceSpecification
     */
    public function getServiceSpecification($service_specification_id)
    {
        return $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\ServiceSpecification', $service_specification_id);
    }
}