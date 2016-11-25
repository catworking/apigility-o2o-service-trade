<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/25
 * Time: 12:06
 */
namespace ApigilityO2oServiceTrade\Service\Exception;

class ServiceNotExistException extends \Exception
{
    const CODE = 404;
    const MESSAGE = '服务不存在';
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}