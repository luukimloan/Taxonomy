<?php
namespace Menu\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Menu\Entity\Menu;
use Menu\Form\MenuFilter;

 class MenuForm extends Form
 {
     private $om;

     public function __construct(ObjectManager $objectManager)
     {        
         // we want to ignore the name passed
         parent::__construct('menu');

         $this->om=$objectManager;

         $this->setHydrator(new DoctrineHydrator($objectManager))
              ->setInputFilter(new MenuFilter())
              ->setObject(new Menu());

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'ten',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Tên',
             ),

             'attributes'=>array('required'=>'required'),
         ));
         $this->add(array(
             'name' => 'dinhTuyen',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Dinh Tuyen',                 
             ),
         ));

         $this->add(array(
             'name' => 'thamSo',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Tham So',                 
             ),
         ));

         $this->add(array(
             'name' => 'loai',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Loai',                 
             ),
         ));

         $this->add(array(
             'name' => 'cha',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Cha',
             'empty_option'=>'--Chọn giá trị--',
             'value_options'=>$this->getDanhMucOption(),
             ),
         ));

         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }

     public function getDanhMucOption()
     {
        $options=array();
        $dms=$this->om->getRepository('Menu\Entity\Menu')->findAll();
        //var_dump($dms);
        foreach ($dms as $dm)
        {
            $options[$dm->getId()]=$dm->getTen();
        }
        //var_dump($options);
        return $options;

     }
 }