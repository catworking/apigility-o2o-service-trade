<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Service;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class ServiceResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\ServiceService
     */
    protected $serviceService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->serviceService = $services->get('ApigilityO2oServiceTrade\Service\ServiceService');
    }

    /**
     * 获取单个服务
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        try {
            return new ServiceEntity($this->serviceService->getService($id), $this->serviceManager);
        } catch (\Exception $exception){
            return new ApiProblem($exception->getCode(), $exception);
        }
    }

    /**
     * 获取服务列表
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        try {
            return new ServiceCollection($this->serviceService->getServices($params), $this->serviceManager);
        } catch (\Exception $exception){
            return new ApiProblem($exception->getCode(), $exception);
        }
    }
}
