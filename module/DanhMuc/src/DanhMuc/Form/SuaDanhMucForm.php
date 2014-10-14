<?php
namespace DanhMuc\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use DanhMuc\Entity\DanhMuc;
use DanhMuc\Form\DanhMucFilter;

 class SuaDanhMucForm extends Form
 {
     private $om;

     public function __construct(ObjectManager $objectManager,$id)//Thêm $id
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
             'value_options'=>$this->getDanhMucOption($id),//Thêm $id
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

     public function getDanhMucOption($id)//Thêm $id
     {
        //Thực hiện truy vấn với điều kiện id truyền vào
        $options=array();
        $dmq=$this->om->getRepository('DanhMuc\Entity\DanhMuc');

        $queryBuilder=$dmq->createQueryBuilder('dm');
        $queryBuilder->add('where', 'dm.id !='.$id);
        $query = $queryBuilder->getQuery();
        $dms = $query->execute();

        //$dms=$this->parseTree($dms,$id);
        $dms=$this->xoacon($dms,$id);//Gọi hàm xóa con
        
        //var_mdup($dms);
        foreach ($dms as $dm)
        {
            $options[$dm->getId()]=$dm->getTen();
        }
        //var_dump($options);
        return $options;
     }  

//hàm loại bỏ con của một id truyền vào
     public function xoacon($tree,$id=null)     
     {
        foreach ($tree as $i=>$con)            
        {
            $cha=$con->getCha();
            if($cha)
            {
                if($cha->getId()==$id)
                {
                    unset($tree[$i]);
                    $tree=$this->xoacon($tree,$con->getId());
                }
            }
        }
        return $tree;
     }
     //
     
     /*public function parseTree($tree, $root = null) 
     {
        foreach($tree as $i=>$child) 
        {
            $parent = $child->getCha();
            if($parent)
                if($parent->getId() == $root) 
                {
                    unset($tree[$i]);//unset: xóa phần tử khỏi mảng
                    $tree = $this->parseTree($tree, $child->getId());                   
                }
        }
        return $tree;    
    }*/

 }
