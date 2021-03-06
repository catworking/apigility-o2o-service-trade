<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/7
 * Time: 16:31
 */
namespace ApigilityO2oServiceTrade\Service;

use ApigilityUser\DoctrineEntity\Identity;
use ApigilityUser\DoctrineEntity\User;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityO2oServiceTrade\DoctrineEntity;

class CustomerService
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
     * 创建一个客户
     *
     * @param User $user
     * @param DoctrineEntity\Individual $individual
     * @return DoctrineEntity\Customer
     */
    public function createCustomer(User $user, DoctrineEntity\Individual $individual)
    {
        $customer = new DoctrineEntity\Customer();
        $customer->setUser($user)
            ->setIndividual($individual)
            ->setCreateTime(new \DateTime());
        $this->em->persist($customer);
        $this->em->flush();

        return $customer;
    }

    /**
     * 获取一个客户
     *
     * @param $customer_id
     * @return DoctrineEntity\Customer
     * @throws \Exception
     */
    public function getCustomer($customer_id)
    {
        $customer = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Customer', $customer_id);
        if (empty($customer)) throw new \Exception(404, '客户不存在');

        return $customer;
    }

    /**
     * 获取客户列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     * @internal param $individual_id
     */
    public function getCustomers($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('c')->from('ApigilityO2oServiceTrade\DoctrineEntity\Customer', 'c');

        $where = null;
        if (isset($params->individual_id)) {
            $qb->innerJoin('c.individual', 'i');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'i.id = :individual_id';
        }

        if (isset($params->user_id)) {
            $qb->innerJoin('c.user', 'u');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'u.id = :user_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->individual_id)) $qb->setParameter('individual_id', $params->individual_id);
            if (isset($params->user_id)) $qb->setParameter('user_id', $params->user_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    public function updateCustomer($customer_id, $data, Identity $identity)
    {
        $customer = $this->getCustomer($customer_id);
        if ($identity->getType() === 'individual' && $customer->getIndividual()->getUser()->getId() === $identity->getId()) {
            if (isset($data->remark)) $customer->setRemark($data->remark);
            $this->em->flush();

            return $customer;
        } else {
            throw new \Exception('没有权限修改客户数据', 403);
        }
    }

    public function existCustomer(User $user, DoctrineEntity\Individual $individual)
    {
        $params = new \stdClass();
        $params->user_id = $user->getId();
        $params->individual_id = $individual->getId();
        $rs = $this->getCustomers($params);

        if ($rs->count() > 0) return true;
        else return false;
    }
}