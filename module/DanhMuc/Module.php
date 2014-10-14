<?php
namespace DanhMuc;

use Zend\Mvc\MvcEvent;
use Zend\Form\Form;
class Module
{    

    public function onBootstrap(MvcEvent $e)
    {

        //----------
        $services=$e->getApplication()->getServiceManager();
        $zfcServiceEvents=$services->get('zfcuser_user_service')->getEventManager();
        
        $zfcServiceEvents->attach('register',function($e) use($services){
            $user=$e->getParam('user');
            $em=$services->get('Doctrine\ORM\EntityManager');
            $defaultUserRole=$em->getRepository('DanhMuc\Entity\Role')
                                ->findOneBy(array('roleId'=>'nguoi-dung'));
            $user->addRole($defaultUserRole);
        });
        //-----



        $events= $e->getApplication()->getEventManager()->getSharedManager();

        //Bắt sự kiện
        //Cách attach 2 sử dụng service
        $DanhMucServiceEvents=$services->get('danh_muc_service')->getEventManager();
        $DanhMucServiceEvents->attach('phatEvent',function($e)
            {                
                $event=$e->getName();                
                $target=$e->getTarget();
                $target->flashMessenger()->addMessage('Tên event: '.$event. ', tên target: '.get_class($target));                
            });

        $DanhMucServiceEvents->attach('xoaEV',function($e)
            {                
                $ev=$e->getName();                
                $tg=$e->getTarget();
                $tg->flashMessenger()->addMessage('Tên event: '.$ev. ', tên target: '.get_class($tg));                
            });

        //Cách attach 1

        // $events->attach('DanhMuc\Controller\IndexController','vd', function($e)
        //     {
                
        //         $event=$e->getName();                
        //         $target=$e->getTarget();
        //         $target->flashMessenger()->addMessage('Tên event: '.$event. ', tên target: '.get_class($target));//echo 'Thanh cong';
        //     }
        // );
        //


        $zfcServiceEvents = $e->getApplication()->getServiceManager()->get('zfcuser_user_service')->getEventManager();

        $events->attach('ZfcUser\Form\Register', 'init', function($e) {
            $form = $e->getTarget();
             $form->add(array(
                'name' => 'username',
                'type' => 'Text',
                'options' => array(
                        'label' => 'User name: ',
                ),
            ));
            $form->add(array(
                'name' => 'name',
                'type' => 'Text',
                'options' => array(
                        'label' => 'Display name: ',
                ),
            ));         
        });


        $events->attach('ZfcUser\Form\RegisterFilter','init', function($e) {
            $filter = $e->getTarget();
        // Do what you please with the filter instance ($filter)
            $filter->add(array(
                    'name'       => 'username',
                    'required'   => true,
                    'validators' => array(
                        array(
                            'name'    => 'StringLength',
                            'options' =>array(
                                'min' => 3,
                                'max' => 255,
                                'message'=>array('The input is less than 3 characters long'=>'Ít nhất 3 kí tự'),
                            ),
                        ),
                    ),
            ));

            $filter->add(array(
                'name'       => 'name',
                'required'   => true,
                'validators' => array(
                        array(
                                'name'    => 'StringLength',
                                'options' => array(
                                        'min' => 3,
                                        'max' => 255,
                                ),
                        ),
                ),
        ));

        });

        $zfcServiceEvents->attach('register', function($e) {
        $user = $e->getParam('user');  // User account object
        $form = $e->getParam('form');  // Form object
        //var_dump($form->get('firstname')->getValue()); die;
        //var_dump($user); die;
        });

        $zfcServiceEvents->attach('register.post', function($e) {
        $user = $e->getParam('user');
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }    
}