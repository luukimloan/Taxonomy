<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Menu\Controller\Index' => 'Menu\Controller\IndexController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'menu' => array(
                 'type'    => 'segment', 
                 'options' => array(
                     'route'    => '/menu[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Menu\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'menu' => __DIR__ . '/../view',
             ),         
         ), 

    'doctrine' => array(
        'driver' => array(

            'menu_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/Menu/Entity',//Edit
                ),
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Menu\Entity' => 'menu_annotation_driver'//Edit
                )
            )
        )
    ),
/*
    'service_manager'=>array(
        'factories'=> array(
            'menu'=>'Menu\Navigation\Service\MenuNavigationFactory', //goi class trong MenuNavigationFactory.php
            )
        ),        */
 );