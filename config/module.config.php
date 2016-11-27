<?php
return [
    'service_manager' => [
        'factories' => [
            \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceResource::class => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceResourceFactory::class,
            \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryResource::class => \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryResourceFactory::class,
            \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationResource::class => \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationResourceFactory::class,
            \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationResource::class => \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'apigility-o2o-service-trade.rest.service' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/o2oservicetrade/service[/:service_id]',
                    'defaults' => [
                        'controller' => 'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller',
                    ],
                ],
            ],
            'apigility-o2o-service-trade.rest.service-category' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/o2oservicetrade/service[/:service_id]/category[/:service_category_id]',
                    'defaults' => [
                        'controller' => 'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceCategory\\Controller',
                    ],
                ],
            ],
            'apigility-o2o-service-trade.rest.service-specification' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/o2oservicetrade/service[/:service_id]/specification[/:service_specification_id]',
                    'defaults' => [
                        'controller' => 'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller',
                    ],
                ],
            ],
            'apigility-o2o-service-trade.rest.service-organization' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/o2oservicetrade/service[/:service_id]/organization[/:service_organization_id]',
                    'defaults' => [
                        'controller' => 'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceOrganization\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'apigility-o2o-service-trade.rest.service',
            1 => 'apigility-o2o-service-trade.rest.service-category',
            2 => 'apigility-o2o-service-trade.rest.service-specification',
            3 => 'apigility-o2o-service-trade.rest.service-organization',
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
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
                0 => 'type',
                1 => 'service_category_id',
            ],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceEntity::class,
            'collection_class' => \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceCollection::class,
            'service_name' => 'service',
        ],
        'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceCategory\\Controller' => [
            'listener' => \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryResource::class,
            'route_name' => 'apigility-o2o-service-trade.rest.service-category',
            'route_identifier_name' => 'service_category_id',
            'collection_name' => 'service_category',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => '5',
            'page_size_param' => null,
            'entity_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryEntity::class,
            'collection_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryCollection::class,
            'service_name' => 'serviceCategory',
        ],
        'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller' => [
            'listener' => \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationResource::class,
            'route_name' => 'apigility-o2o-service-trade.rest.service-specification',
            'route_identifier_name' => 'service_specification_id',
            'collection_name' => 'service_specification',
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
            'entity_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationEntity::class,
            'collection_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationCollection::class,
            'service_name' => 'ServiceSpecification',
        ],
        'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceOrganization\\Controller' => [
            'listener' => \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationResource::class,
            'route_name' => 'apigility-o2o-service-trade.rest.service-organization',
            'route_identifier_name' => 'service_organization_id',
            'collection_name' => 'service_organization',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationEntity::class,
            'collection_class' => \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationCollection::class,
            'service_name' => 'ServiceOrganization',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => 'HalJson',
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceCategory\\Controller' => 'HalJson',
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller' => 'HalJson',
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceOrganization\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceCategory\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceOrganization\\Controller' => [
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
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceCategory\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/json',
            ],
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller' => [
                0 => 'application/vnd.apigility-o2o-service-trade.v1+json',
                1 => 'application/json',
            ],
            'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceOrganization\\Controller' => [
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
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\Service\ServiceCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service',
                'route_identifier_name' => 'service_id',
                'is_collection' => true,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-category',
                'route_identifier_name' => 'service_category_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceCategory\ServiceCategoryCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-category',
                'route_identifier_name' => 'service_category_id',
                'is_collection' => true,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-specification',
                'route_identifier_name' => 'service_specification_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceSpecification\ServiceSpecificationCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-specification',
                'route_identifier_name' => 'service_specification_id',
                'is_collection' => true,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-organization',
                'route_identifier_name' => 'service_organization_id',
                'hydrator' => \Zend\Hydrator\ClassMethods::class,
            ],
            \ApigilityO2oServiceTrade\V1\Rest\ServiceOrganization\ServiceOrganizationCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'apigility-o2o-service-trade.rest.service-organization',
                'route_identifier_name' => 'service_organization_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Controller' => [
            'input_filter' => 'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Validator',
        ],
        'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Controller' => [
            'input_filter' => 'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'ApigilityO2oServiceTrade\\V1\\Rest\\Service\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'field_type' => 'int',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'type',
                'description' => '服务类型',
                'field_type' => 'int',
                'error_message' => '请输入服务类型',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'title',
                'description' => '服务的标题',
                'field_type' => 'string',
                'error_message' => '请输入服务标题',
            ],
            3 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'image',
                'description' => '服务的主题图片',
                'error_message' => '请输入服务的主题图片',
                'field_type' => 'string',
            ],
            4 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'description',
                'description' => '服务的描述',
                'field_type' => 'string',
                'error_message' => '请输入服务的描述',
            ],
        ],
        'ApigilityO2oServiceTrade\\V1\\Rest\\ServiceSpecification\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'field_type' => 'int',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'name',
                'description' => '规格名',
                'field_type' => 'string',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'price',
                'description' => '价格',
                'field_type' => 'float',
            ],
        ],
    ],
];
