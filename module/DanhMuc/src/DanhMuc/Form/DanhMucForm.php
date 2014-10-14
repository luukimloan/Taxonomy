<?php
namespace DanhMuc\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DanhMuc\Entity\DanhMuc;
use DanhMuc\Form\DanhMucFilter;

 class DanhMucForm extends Form
 {
     private $om;

     public function __construct(ObjectManager $objectManager)
     {        
         // we want to ignore the name passed
         parent::__construct('danh-muc');

         $this->om=$objectManager;

         $this->setHydrator(new DoctrineHydrator($objectManager))
              ->setInputFilter(new DanhMucFilter())
              ->setObject(new DanhMuc());
// Định nghĩa các element trong form
         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'ten',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Ten',
             ),

             'attributes'=>array('required'=>'required'),
         ));
         $this->add(array(
             'name' => 'moTa',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Mo ta',                 
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
        $dms=$this->om->getRepository('DanhMuc\Entity\DanhMuc')->findAll();
        //var_dump($dms);
        foreach ($dms as $dm)
        {
            $options[$dm->getId()]=$dm->getTen();
        }
        //var_dump($options);
        return $options;
     }     
 }