<?php
return array(
	'controllers' => array(
         'invokables' => array(
             'Test\Controller\Index' => 'Test\Controller\IndexController',
         ),
     ),

	'router' => array(
         'routes' => array(
             'test_router' => array(
                 'type'    => 'segment', 
                 'options' => array(
                     'route'    => '/test[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Test\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

	'view_manager' => array(
         'template_path_stack' => array(
             'test_view' => __DIR__ . '/../view',
         ),         
     ),


    'doctrine' => array(
        'driver' => array(

            'test_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/Test/Entity',//Edit
                ),
            ),

            'orm_default' => array(
                'drivers' => array(

                    'Test\Entity' => 'test_annotation_driver'//Edit
                )
            )
        )
    ),
); 
?>