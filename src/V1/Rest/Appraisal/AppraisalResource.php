<?php
namespace ApigilityO2oServiceTrade\V1\Rest\Appraisal;

use ApigilityCatworkFoundation\Base\ApigilityResource;
use Zend\ServiceManager\ServiceManager;
use ZF\ApiProblem\ApiProblem;

class AppraisalResource extends ApigilityResource
{
    /**
     * @var \ApigilityO2oServiceTrade\Service\AppraisalService
     */
    protected $appraisalService;

    /**
     * @var \ApigilityUser\Service\userService
     */
    protected $userService;

    public function __construct(ServiceManager $services)
    {
        parent::__construct($services);
        $this->appraisalService = $this->serviceManager->get('ApigilityO2oServiceTrade\Service\AppraisalService');
        $this->userService = $this->serviceManager->get('ApigilityUser\Service\UserService');
    }

    public function create($data)
    {
        try {
            $auth_user = $this->userService->getAuthUser();
            return new AppraisalEntity($this->appraisalService->createAppraisal($data, $auth_user), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetch($id)
    {
        try {
            return new AppraisalEntity($this->appraisalService->getAppraisal($id), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }

    public function fetchAll($params = [])
    {
        try {
            return new AppraisalCollection($this->appraisalService->getAppraisals($params), $this->serviceManager);
        } catch (\Exception $exception) {
            return new ApiProblem($exception->getCode(), $exception->getMessage());
        }
    }
}
