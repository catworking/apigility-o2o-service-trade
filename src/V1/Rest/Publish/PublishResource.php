<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Publish;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class PublishResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\PublishService
     */
    protected $publishService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->publishService = $services->get('ApigilityO2oServiceTrade\Service\PublishService');
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
            return new PublishEntity($this->publishService->getPublish($id), $this->serviceManager);
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
            return new PublishCollection($this->publishService->getPublishes($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
