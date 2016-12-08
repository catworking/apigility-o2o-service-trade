<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Organization;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class OrganizationResource extends ApigilityResource
{
    protected $organizationService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->organizationService = $services->get('ApigilityO2oServiceTrade\Service\OrganizationService');
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
            return new OrganizationEntity($this->organizationService->getOrganization($id), $this->serviceManager);
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
            return new OrganizationCollection($this->organizationService->getOrganizations($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
