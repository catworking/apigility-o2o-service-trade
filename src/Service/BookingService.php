<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 9:47
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

class BookingService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityOrder\Service\OrderService
     */
    protected $orderService;

    /**
     * @var \ApigilityO2oServiceTrade\Service\ServiceService
     */
    protected $serviceService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->orderService = $services->get('ApigilityOrder\Service\OrderService');
        $this->serviceService = $services->get('ApigilityO2oServiceTrade\Service\ServiceService');
    }

    /**
     * 创建一个预订单
     *
     * @param $user
     * @param $service_specification_id
     * @param $quantity
     * @param $booking_data
     * @return DoctrineEntity\Booking
     */
    public function createBooking($user, $service_specification_id, $quantity, $booking_data)
    {
        $service_specification = $this->serviceService->getServiceSpecification($service_specification_id);
        $service = $service_specification->getService();

        $order = $this->orderService->createOrder($service->getTitle(), $user);
        $this->orderService->createOrderDetail(
            $order,
            $service_specification->getName(),
            $service_specification->getPrice(),
            $quantity,
            $service->getId(),
            $service_specification->getId()
        );

        $booking = new DoctrineEntity\Booking();
        $booking->setUser($user);
        $booking->setOrder($order);
        $booking->setService($service);
        $booking->setBookingData($booking_data);

        $this->em->persist($booking);
        $this->em->flush();

        return $booking;
    }

    /**
     * 获取一个预订单
     *
     * @param $booking_id
     * @return DoctrineEntity\Booking
     * @throws \Exception
     */
    public function getBooking($booking_id)
    {
        $booking = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Booking', $booking_id);
        if (empty($booking)) throw new \Exception(404, '预订单不存在');

        return $booking;
    }

    /**
     * 获取预订列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     * @internal param $user_id
     */
    public function getBookings($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('b')->from('ApigilityO2oServiceTrade\DoctrineEntity\Booking', 'b');

        $where = null;
        if (isset($params->status)) {
            $qb->innerJoin('b.order', 'bo');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'bo.status = :status';
        }

        if (isset($params->user_id)) {
            $qb->innerJoin('b.user', 'bu');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'bu.id = :user_id';
        }

        if (isset($params->individual_id)) {
            $qb->innerJoin('b.service', 's');
            $qb->innerJoin('s.individual', 'si');
            if (!empty($where)) $where .= ' AND ';
            $where .= '(si.id = :individual_id)';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->status)) $qb->setParameter('status', $params->status);
            if (isset($params->user_id)) $qb->setParameter('user_id', $params->user_id);
            if (isset($params->individual_id)) {
                $qb->setParameter('individual_id', $params->individual_id);
            }
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}