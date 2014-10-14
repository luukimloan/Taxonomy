<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Album2\Controller\Index' => 'Album2\Controller\IndexController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'album2' => array(
                 'type'    => 'segment', 
                 'options' => array(
                     'route'    => '/album2[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Album2\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'album2' => __DIR__ . '/../view',
             ),         
         ), 

    'doctrine' => array(
        'driver' => array(

            'album2_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/Album2/Entity',//Edit
                ),
            ),

            'orm_default' => array(
                'drivers' => array(

                    'Album2\Entity' => 'album2_annotation_driver'//Edit
                )
            )
        )
    )        
 );