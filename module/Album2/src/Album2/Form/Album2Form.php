<?php
namespace Album2\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Album2\Entity\Album;

 class Album2Form extends Form
 {
     public function __construct(ObjectManager $objectManager)
     {
         // we want to ignore the name passed
         parent::__construct('album');

         $this->setHydrator(new DoctrineHydrator($objectManager))
              ->setObject(new Album());

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'title',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'artist',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Artist',
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
 }