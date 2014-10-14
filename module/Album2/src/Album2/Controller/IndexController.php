<?php namespace Album2\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel; 
 use Album2\Entity\Album;//Trỏ tới class Album
 use Album2\Form\Album2Form;

 class IndexController extends AbstractActionController
 {
     private $entityManager;

     public function getEntityManager()
     {
        if(!$this->entityManager)
        {
          $this->entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;      
     }

     public function indexAction()
     {
          
          $objectManager=$this->getEntityManager();
          //$objectManager=$this->getEntityManager();
          $albums=$objectManager->getRepository('Album2\Entity\Album')->findAll();

          return array('albums'=>$albums);
     }

     public function addAction()
     {
         $objectManager=$this->getEntityManager();
         $album=new Album();
         $form=new Album2Form($objectManager);
         $form->bind($album);

         $request = $this->getRequest();
         if ($request->isPost()) {     
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
               $objectManager->persist($album);
               $objectManager->flush();

               return $this->redirect()->toRoute('album2');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {        
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album2', array(
                 'action' => 'add'
             ));
         }

         $objectManager=$this->getEntityManager();
         $album= $objectManager->getRepository('Album2\Entity\Album')->find($id);
         $form=new Album2Form($objectManager);                          
         
         $form->bind($album);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {                
                  $objectManager->flush();

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('album2');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         ); 
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('album2');
         }

         $objectManager=$this->getEntityManager();
         $album= $objectManager->getRepository('Album2\Entity\Album')->find($id);
         $form=new Album2Form($objectManager);

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');

                 $objectManager->remove($album);
                 $objectManager->flush();
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('album2');
         }

         return array(
             'id'    => $id,
             'album' => $album,
         );
     }

     public function getAlbumTable()
     {
         
     }     
 }