<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceResource::class => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-o2o-service-trade.rest.service' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/service[/:service_id]',
                    'defaults' => [
                        'controller' => 'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-o2o-service-trade.rest.service',
        ],
    ],
    'zf-rest' => [
        'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => [
            'listener' => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceResource::class,
            'route_name' => 'apigility-o2o-service-trade.rest.service',
            'route_identifier_name' => 'service_id',
            'collection_name' => 'service',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity::class,
            'collection_class' => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceCollection::class,
            'service_name' => 'service',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service',
                'route_identifier_name' => 'service_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service',
                'route_identifier_name' => 'service_id',
                'is_collection' => true,
            ],
        ],
    ],
];
