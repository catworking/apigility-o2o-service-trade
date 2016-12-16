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
            $user = $this->userService->getAuthUser();
            $booking = $this->bookingService->createBooking($user, $data);
            return new BookingEntity($booking, $this->serviceManager);
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
            return new BookingEntity($this->bookingService->getBooking($id), $this->serviceManager);
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
            return new BookingCollection($this->bookingService->getBookings($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            $auth_user = $this->userService->getAuthUser();
            return new BookingEntity($this->bookingService->updateBooking($id, $data, $auth_user), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
