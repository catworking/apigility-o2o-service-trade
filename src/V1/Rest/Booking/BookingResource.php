<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Booking;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;

class BookingResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\BookingService
     */
    protected $bookingService;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->bookingService = $services->get('ApigilityO2oServiceTrade\Service\BookingService');
        $this->userService = $services->get('ApigilityUser\Service\UserService');
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        try {
            $booking_data = '{}';
            if (isset($data->booking_data)) $booking_data = $data->booking_data;

            $user = $this->userService->getAuthUser();

            $booking = $this->bookingService->createBooking($user, $data->service_specification_id, $data->quantity, $booking_data);
            return new BookingEntity($booking);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            return new BookingEntity($this->bookingService->getBooking($id));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        try {
            return new BookingCollection($this->bookingService->getBookings($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
