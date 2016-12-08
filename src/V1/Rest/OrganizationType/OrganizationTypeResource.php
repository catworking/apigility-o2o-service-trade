<?php
namespace ApigilityO2oServiceTrade\V1\Rest\OrganizationType;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class OrganizationTypeResource extends ApigilityResource
{
    protected $organizationTypeService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->organizationTypeService = $services->get('ApigilityO2oServiceTrade\Service\OrganizationTypeService');
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
            return new OrganizationTypeEntity($this->organizationTypeService->getOrganizationType($id));
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
            return new OrganizationTypeCollection($this->organizationTypeService->getOrganizationTypes());
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
