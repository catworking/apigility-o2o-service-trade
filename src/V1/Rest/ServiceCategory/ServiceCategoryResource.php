<?php
namespace ApigilityO2oServiceTrade\V1\Rest\ServiceCategory;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use Zend\ServiceManager\ServiceManager;

class ServiceCategoryResource extends ApigilityResource
{
    protected $serviceService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->serviceService = $services->get('ApigilityO2oServiceTrade\Service\ServiceService');
    }

    /**
     * 获取服务分类列表
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        try {
            return new ServiceCategoryCollection($this->serviceService->getServiceCategories($params));
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception);
        }
    }
}
