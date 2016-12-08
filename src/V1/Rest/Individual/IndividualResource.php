<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Individual;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Zend\ServiceManager\ServiceManager;

class IndividualResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\IndividualService
     */
    protected $individualService;

    /**
     * @var \ApigilityUser\Service\UserService
     */
    protected $userService;

    /**
     * @var \ApigilityUser\Service\IdentityService
     */
    protected $identityService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->individualService = $services->get('ApigilityO2oServiceTrade\Service\IndividualService');
        $this->userService = $services->get('ApigilityUser\Service\UserService');
        $this->identityService = $services->get('ApigilityUser\Service\IdentityService');
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
            return new IndividualEntity($this->individualService->getIndividual($id), $this->serviceManager);
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
            return new IndividualCollection($this->individualService->getIndividuals($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function patch($id, $data)
    {
        try {
            $auth_user = $this->userService->getAuthUser();
            $identity = $this->identityService->getIdentity($auth_user->getId());
            return new IndividualEntity($this->individualService->updateIndividual($id, $data, $identity), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
