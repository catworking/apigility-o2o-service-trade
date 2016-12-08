<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class ServiceSpecificationResource extends ApigilityResource
{
    protected $serviceService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->serviceService = $services->get('ApigilityO2oServiceTrade\Service\ServiceService');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $service_id = (int)$this->getEvent()->getRouteParam('service_id');

        try {
            return new ServiceSpecificationCollection($this->serviceService->getServiceSpecifications($service_id), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception);
        }
    }
}
