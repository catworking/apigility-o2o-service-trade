<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/15
 * Time: 11:37
 */
namespace ApigilityO2oServiceTrade;

use ApigilityO2oServiceTrade\DoctrineEntity\Individual;
use ApigilityO2oServiceTrade\Service\BookingService;
use ApigilityOrder\Service\PaymentService;
use ApigilityUser\DoctrineEntity\User;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceManager;
use ApigilityFinance\DoctrineEntity\Ledger;

class BookingListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    private $services;

    /**
     * @var \ApigilityO2oServiceTrade\Service\BookingService
     */
    private $bookingService;

    /**
     * @var \ApigilityFinance\Service\LedgerService
     */
    protected $ledgerService;

    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(PaymentService::EVENT_PAY_SUCCESS, [$this, 'createLedger'], $priority);
    }

    public function createLedger(EventInterface $e)
    {
        $params = $e->getParams();
        $order = $params['order'];

        $this->bookingService = $this->services->get('ApigilityO2oServiceTrade\Service\BookingService');
        $booking_params = new \stdClass();
        $booking_params->order_id = $order->getId();
        $rs = $this->bookingService->getBookings($booking_params);

        if ($rs->count() > 0){
            $booking = $rs->getItems(0,1)[0];
            $individual = $booking->getIndividual();

            if ($individual instanceof Individual) {
                $this->ledgerService = $this->services->get('ApigilityFinance\Service\LedgerService');

                // 处理财务记账
                $ledger_data = new \stdClass();
                $ledger_data->user_id = $individual->getUser()->getId();
                $ledger_data->account = 'default';
                $ledger_data->amount = $order->getTotal();
                $ledger_data->amount_type = Ledger::AMOUNT_TYPE_DEBIT;
                $this->ledgerService->createLedger($ledger_data);
            }
        }
    }
}