<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Customer;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class CustomerResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\CustomerService
     */
    protected $customerService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->customerService = $services->get('ApigilityO2oServiceTrade\Service\CustomerService');
    }

    public function fetch($id)
    {
        try {
            return new CustomerEntity($this->customerService->getCustomer($id));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new CustomerCollection($this->customerService->getCustomers($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
