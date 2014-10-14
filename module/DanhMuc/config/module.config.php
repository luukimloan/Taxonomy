<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'DanhMuc\Controller\Index' => 'DanhMuc\Controller\IndexController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
        'routes' => array(
            'danh_muc' => array(
                'type'    => 'literal', 
                'options' => array(
                    'route'    => '/danh-muc',                     
                    'defaults' => array(
                       '__NAMESPACE__'=>'DanhMuc\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                    
                    'crud' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/][:action][/:id]',
                            'constraints' => array(                            
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),                            
                        ),
                    ),

                    'paginator' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[trang-:page]',//'page'->Sử dụng page phía dưới                            
                            'defaults' => array(
                                'page'=>1,
                            ),
                        ),
                    ),
                ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'danh_muc' => __DIR__ . '/../view',
             ), 
     'template_map'=>array(
         'paginator/my_paginator'=>__DIR__ .'/../view/partial/paginator/my-paginator.phtml',
            ),        
         ), 

    'doctrine' => array(
        'driver' => array(

            'danh_muc_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/DanhMuc/Entity',//Edit
                ),
            ),

            'orm_default' => array(
                'drivers' => array(

                    'DanhMuc\Entity' => 'danh_muc_annotation_driver'//Edit
                )
            )
        )
    ),

    'service_manager'=>array(
        'factories'=> array(
            'danh_muc'=>'DanhMuc\Navigation\Service\DanhMucNavigationFactory', //goi class trong TrangChuNavigationFactory.php
            ),
        //Không sử dụng factories vì không có instance factories
        'invokables'=>array(
            'danh_muc_service'=>'DanhMuc\Service\DanhMucService',
            ),
        ),

    'view_helpers'=>array(
        'invokables'=>array(
            'my_menu'=>'DanhMuc\View\Helper\MyMenu',
            )
        ),

    //Phần Plugin
     'controller_plugins' => array(
        'invokables' => array(
            'my_plugin' => 'DanhMuc\Controller\Plugin\MyPlugin',
        ),
     ),

     
//Phân quyền
/*
    'bjyauthorize'=>array(
        'guards'=>array(
            'BjyAuthorize\Guard\Controller'=>array(
                
                array(
                    'controller'=>array('zfcuser'),
                    'roles'=>array(),
                ),
                array(
                    'controller'=>array('DanhMuc\Controller\Index'),//== row 5
                    'action'=>array('add','edit','delete'),
                    'roles'=>array('nguoi-dung'),
                ),
                array(
                    'controller'=>array('DanhMuc\Controller\Index'),
                    'action'=>array('index','view'),
                    'roles'=>array('khach','nguoi-dung'),
                ),
            ),
        ),
    ), */

 );