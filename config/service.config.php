<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 14:52
 */
return [
    'service_manager' => array(
        'factories' => array(
            'ApigilityO2oServiceTrade\Service\ServiceService' => 'ApigilityO2oServiceTrade\Service\ServiceServiceFactory',
            'ApigilityO2oServiceTrade\Service\OccupationService' => 'ApigilityO2oServiceTrade\Service\OccupationServiceFactory',
            'ApigilityO2oServiceTrade\Service\IndividualService' => 'ApigilityO2oServiceTrade\Service\IndividualServiceFactory',
            'ApigilityO2oServiceTrade\Service\OrganizationService' => 'ApigilityO2oServiceTrade\Service\OrganizationServiceFactory',
            'ApigilityO2oServiceTrade\Service\OrganizationTypeService' => 'ApigilityO2oServiceTrade\Service\OrganizationTypeServiceFactory',
            'ApigilityO2oServiceTrade\Service\BookingService' => 'ApigilityO2oServiceTrade\Service\BookingServiceFactory',
            'ApigilityO2oServiceTrade\Service\PublishService' => 'ApigilityO2oServiceTrade\Service\PublishServiceFactory',
            'ApigilityO2oServiceTrade\Service\CustomerService' => 'ApigilityO2oServiceTrade\Service\CustomerServiceFactory'
        ),
    )
];