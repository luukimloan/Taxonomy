<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Album\Controller\Index' => 'Album\Controller\IndexController',
         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             'album' => array(
                 'type'    => 'segment', 
                 'options' => array(
                     'route'    => '/album[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Index',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'album' => __DIR__ . '/../view',
             ),
         'template_map'=>array(
                'menu/trang_chu'=>__DIR__ .'/../view/partial/menu/trang-chu.phtml',//dir trả về thư mục cha của thư mục hiện hành
                ),
         ),

     'service_manager'=>array(
        'factories'=> array(
            'trang_chu'=>'Album\Navigation\Service\TrangChuNavigationFactory', //goi class trong TrangChuNavigationFactory.php
            )
        ),

     'navigation' => array(
     'trang_chu'=> array(
        array(
            'label' =>'Thêm album 1',
            'route' => 'album',
            'params' => array('action'=>'add')
            ),
        array(
            'label' =>'Thêm album 2',
            'route' => 'album',
            'params' => array('action'=>'add'),
            'pages' =>array(
                array(
                     'label'=>'Con album 2.1',
                     'route' => 'album',
                     'params' => array('action'=>'add')
                    ),
                )
            )
        )
     )
 );