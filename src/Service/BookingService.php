<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/30
 * Time: 9:47
 */
namespace ApigilityO2oServiceTrade\Service;

use ApigilityCatworkFoundation\Base\ApigilityEventAwareObject;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityO2oServiceTrade\DoctrineEntity;
use ApigilityOrder\DoctrineEntity\Order;
use ApigilityOrder\DoctrineEntity\OrderDetail;

class BookingService extends ApigilityEventAwareObject
{
    const EVENT_BOOKING_CREATED = 'BookingService.EVENT_BOOKING_CREATED';

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

    /**
     * @var \ApigilityO2oServiceTrade\Service\IndividualService
     */
    protected $individualService;

    /**
     * @var \ApigilityO2oServiceTrade\Service\OrganizationService
     */
    protected $organizationService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->orderService = $services->get('ApigilityOrder\Service\OrderService');
        $this->serviceService = $services->get('ApigilityO2oServiceTrade\Service\ServiceService');
        $this->individualService = $services->get('ApigilityO2oServiceTrade\Service\IndividualService');
        $this->organizationService = $services->get('ApigilityO2oServiceTrade\Service\OrganizationService');
    }

    /**
     * 创建一个预订单
     *
     * @param $user
     * @param $data
     * @return DoctrineEntity\Booking
     * @throws \Exception
     * @internal param $service_specification_id
     * @internal param $quantity
     * @internal param $booking_data
     */
    public function createBooking($user, $data)
    {
        $booking_data = '{}';
        if (isset($data->booking_data)) $booking_data = $data->booking_data;

        $service_specification = $this->serviceService->getServiceSpecification($data->service_specification_id);
        $service = $service_specification->getService();

        $individual = null;
        $organization = null;
        if ($service->getType() == $service::TYPE_NONSTANDARD) {
            $individual = $service->getIndividual();
            $organization = $service->getOrganization();
            if (empty($individual) && empty($organization)) throw new \Exception('预订的个性化（非标准化）服务，没有指定服务个体或服务机构，请联系管理员处理', 500);
        } else if ($service->getType() == $service::TYPE_STANDARD) {
            if (!isset($data->individual_id) && !isset($data->organization_id)) {
                // 暂时允许不指定
                // throw new \Exception('预订标准化服务，需要指定服务个体或服务机构', 500);
            } else {
                if (isset($data->individual_id)) {
                    $individual = $this->individualService->getIndividual($data->individual_id);
                }
                if (isset($data->organization_id)) {
                    $organization = $this->organizationService->getOrganization($data->organization_id);
                }
            }
        }

        $order = $this->orderService->createOrder($service->getTitle(), $user);
        $this->orderService->createOrderDetail(
            $order,
            $service_specification->getName(),
            $service_specification->getPrice(),
            $data->quantity,
            $service->getId(),
            $service_specification->getId()
        );

        $booking = new DoctrineEntity\Booking();
        $booking->setUser($user);
        $booking->setOrder($order);
        $booking->setService($service);
        $booking->setBookingData($booking_data);

        if ($individual instanceof DoctrineEntity\Individual) $booking->setIndividual($individual);
        if ($organization instanceof DoctrineEntity\Organization) $booking->setOrganization($organization);

        $this->em->persist($booking);
        $this->em->flush();

        // 创建客户信息
        $this->getEventManager()->trigger(self::EVENT_BOOKING_CREATED, $this, ['booking' => $booking]);

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

            // 处理多个状态
            $statuses = explode(',', $params->status);

            $where .= '(';
            foreach ($statuses as $k=>$status) {
                if ($k > 0) $where .= ' OR ';
                $where .= 'bo.status = :status'.$k;
            }
            $where .= ')';
        }

        if (isset($params->user_id)) {
            $qb->innerJoin('b.user', 'bu');
            if (!empty($where)) $where .= ' AND ';
            $where .= 'bu.id = :user_id';
        }

        if (isset($params->individual_id)) {
            $qb->innerJoin('b.individual', 'bi');
            if (!empty($where)) $where .= ' AND ';
            $where .= '(bi.id = :individual_id)';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->status)) {
                $statuses = explode(',', $params->status);
                foreach ($statuses as $k=>$status) {
                    $qb->setParameter('status'.$k, $status);
                }
            }

            if (isset($params->user_id)) $qb->setParameter('user_id', $params->user_id);
            if (isset($params->individual_id)) {
                $qb->setParameter('individual_id', $params->individual_id);
            }
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }
}