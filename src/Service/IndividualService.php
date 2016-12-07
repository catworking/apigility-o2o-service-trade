<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/28
 * Time: 16:02
 */
namespace ApigilityO2oServiceTrade\Service;

use ApigilityO2oServiceTrade\DoctrineEntity\Individual;
use ApigilityUser\DoctrineEntity\Identity;
use ApigilityUser\DoctrineEntity\User;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;

class IndividualService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    /**
     * @var \ApigilityO2oServiceTrade\Service\OccupationService
     */
    protected $occupationService;

    /**
     * @var \ApigilityO2oServiceTrade\Service\OrganizationService
     */
    protected $organizationService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->userService = $services->get('ApigilityUser\Service\UserService');
        $this->occupationService = $services->get('ApigilityO2oServiceTrade\Service\OccupationService');
        $this->organizationService = $services->get('ApigilityO2oServiceTrade\Service\OrganizationService');
    }

    /**
     * 创建一个个体
     *
     * @param $data
     * @param $user
     * @return Individual
     */
    public function createIndividual($data, User $user = null)
    {
        $individual = new Individual();
        if ($user instanceof User) $individual->setUser($user);
        else {
            if (isset($data->user_id)) {
                $individual->setUser($this->userService->getUser($data->user_id));
            }
        }

        $this->em->persist($individual);
        $this->em->flush();

        return $individual;
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

        $where = null;
        if (isset($params->service_id)) {
            $qb->innerJoin('i.provideServices', 'ips');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'ips.id = :service_id';
        }

        if (isset($params->user_id)) {
            $qb->innerJoin('i.user', 'u');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'u.id = :user_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if ($params->service_id) $qb->setParameter('service_id', $params->service_id);
            if ($params->user_id) $qb->setParameter('user_id', $params->user_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 更新一个个体对象
     *
     * @param $individual_id
     * @param $data
     * @param Identity $identity
     * @return Individual
     * @throws \Exception
     */
    public function updateIndividual($individual_id, $data, Identity $identity)
    {
        $individual = $this->getIndividual($individual_id);
        if ($identity->getType() === 'administrator' || $identity->getType() === 'individual') {

            if ($identity->getType() === 'individual' && $individual->getUser()->getId() !== $identity->getId()) {
                throw new \Exception('你没有权限修改他人的资料', 403);
            } else {
                if (isset($data->occupation_id)) $individual->setOccupation($this->occupationService->getOccupation($data->occupation_id));
                if (isset($data->organization_id)) $individual->setOrganization($this->organizationService->getOrganization($data->organization_id));

                $this->em->flush();

                return $individual;
            }

        } else {
            throw new \Exception('你没有权限修改个体资料', 403);
        }
    }
}