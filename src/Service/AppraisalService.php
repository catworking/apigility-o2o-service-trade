<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/10
 * Time: 17:31
 */
namespace ApigilityO2oServiceTrade\Service;

use ApigilityCommunicate\DoctrineEntity\Notification;
use Zend\ServiceManager\ServiceManager;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrineToolPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrinePaginatorAdapter;
use ApigilityO2oServiceTrade\DoctrineEntity;

class AppraisalService
{
    protected $classMethodsHydrator;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \ApigilityO2oServiceTrade\Service\bookingService
     */
    protected $bookingService;

    /**
     * @var \ApigilityBlog\Service\articleService
     */
    protected $articleService;

    /**
     * @var \ApigilityCommunicate\Service\NotificationService
     */
    protected $notificationService;

    public function __construct(ServiceManager $services)
    {
        $this->classMethodsHydrator = new ClassMethodsHydrator();
        $this->em = $services->get('Doctrine\ORM\EntityManager');
        $this->bookingService = $services->get('ApigilityO2oServiceTrade\Service\BookingService');
        $this->articleService = $services->get('ApigilityBlog\Service\ArticleService');
        $this->notificationService = $services->get('ApigilityCommunicate\Service\NotificationService');
    }

    /**
     * 获取一个评价
     *
     * @param $appraisal_id
     * @return DoctrineEntity\Appraisal
     * @throws \Exception
     */
    public function getAppraisal($appraisal_id)
    {
        $appraisal = $this->em->find('ApigilityO2oServiceTrade\DoctrineEntity\Appraisal', $appraisal_id);
        if (empty($appraisal)) throw new \Exception(404, '评价不存在');

        return $appraisal;
    }

    /**
     * 获取评价列表
     *
     * @param $params
     * @return DoctrinePaginatorAdapter
     */
    public function getAppraisals($params)
    {
        $qb = new QueryBuilder($this->em);
        $qb->select('a')->from('ApigilityO2oServiceTrade\DoctrineEntity\Appraisal', 'a');

        $where = null;
        if (isset($params->user_id)) {
            $qb->innerJoin('a.user', 'u');
            if (!empty($where)) $where .= ' AND ';
            $where = 'u.id = :user_id';
        }

        if (isset($params->booking_id)) {
            $qb->innerJoin('a.booking', 'b');
            if (!empty($where)) $where .= ' AND ';
            $where = 'b.id = :booking_id';
        }

        if (isset($params->service_id)) {
            $qb->innerJoin('a.service', 's');
            if (!empty($where)) $where .= ' AND ';
            $where = 's.id = :service_id';
        }

        if (isset($params->individual_id)) {
            $qb->innerJoin('a.individual', 'i');
            if (!empty($where)) $where .= ' AND ';
            $where = 'i.id = :individual_id';
        }

        if (!empty($where)) {
            $qb->where($where);
            if (isset($params->user_id)) $qb->setParameter('user_id', $params->user_id);
            if (isset($params->booking_id)) $qb->setParameter('booking_id', $params->booking_id);
            if (isset($params->service_id)) $qb->setParameter('service_id', $params->service_id);
            if (isset($params->individual_id)) $qb->setParameter('individual_id', $params->individual_id);
        }

        $doctrine_paginator = new DoctrineToolPaginator($qb->getQuery());
        return new DoctrinePaginatorAdapter($doctrine_paginator);
    }

    /**
     * 创建一条评价
     *
     * @param $data
     * @param $user
     * @return DoctrineEntity\Appraisal
     */
    public function createAppraisal($data, $user)
    {
        $article = $this->articleService->getArticle($data->article_id);
        $booking = $this->bookingService->getBooking($data->booking_id);
        $service = $booking->getService();
        $individual = $service->getIndividual();

        $appraisal = new DoctrineEntity\Appraisal();
        $appraisal->setUser($user)
            ->setCreateTime(new \DateTime())
            ->setStatus(DoctrineEntity\Appraisal::STATUS_NONE)
            ->setBooking($booking)
            ->setService($service)
            ->setIndividual($individual)
            ->setArticle($article);

        $this->em->persist($appraisal);
        $this->em->flush();

        // 发送用户通知
        if (!empty($individual)) {
            $notification_data = new \stdClass();
            $notification_data->user_id = $individual->getUser()->getId();
            $notification_data->type = 'appraisal';
            $notification_data->object_id = $appraisal->getId();
            $notification_data->title = '收到新的评价';
            $notification_data->content = '你的服务项目：「'.$service->getTitle().'」收到新的评价。';
            $this->notificationService->createNotification($notification_data);
        }

        return $appraisal;
    }
}