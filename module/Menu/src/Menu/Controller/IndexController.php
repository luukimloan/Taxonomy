<?php namespace Menu\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel; 
 use Menu\Entity\Menu;//Trỏ tới class Menu
 use Menu\Form\MenuForm;

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
          $menus=$objectManager->getRepository('Menu\Entity\Menu')->findAll();

          return array('menus'=>$menus);
     }

     public function addAction()
     {
         $objectManager=$this->getEntityManager();
         $menu=new Menu();
         $form=new MenuForm($objectManager);
         $form->bind($menu);

         $request = $this->getRequest();
         if ($request->isPost()) {     
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
               $objectManager->persist($menu);
               $objectManager->flush();

               return $this->redirect()->toRoute('menu');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {        
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('menu', array(
                 'action' => 'add'
             ));
         }

         $objectManager=$this->getEntityManager();
         $menu= $objectManager->getRepository('Menu\Entity\Menu')->find($id);
         $form=new MenuForm($objectManager);                          
         
         $form->bind($menu);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {                
                  $objectManager->flush();

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('menu');
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
             return $this->redirect()->toRoute('menu');
         }

         $objectManager=$this->getEntityManager();
         $menu= $objectManager->getRepository('Menu\Entity\Menu')->find($id);
         $form=new MenuForm($objectManager);

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');

                 $objectManager->remove($menu);
                 $objectManager->flush();
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('menu');
         }

         return array(
             'id'    => $id,
             'menu' => $menu,
         );
     }

     
 }