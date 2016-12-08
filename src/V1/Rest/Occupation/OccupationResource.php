<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Occupation;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class OccupationResource extends ApigilityResource
{
    protected $occupationService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->occupationService = $services->get('ApigilityO2oServiceTrade\Service\OccupationService');
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
            return new OccupationEntity($this->occupationService->getOccupation($id));
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
            return new OccupationCollection($this->occupationService->getOccupations());
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
