<?php namespace DanhMuc\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel; 
 use DanhMuc\Entity\DanhMuc;//Trỏ tới class Danh muc
 use DanhMuc\Form\DanhMucForm;
 use DanhMuc\Form\SuaDanhMucForm;

 use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
 use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
 use Zend\Paginator\Paginator;
 use ZfcBase\EventManager\EventProvider;
 use Zend\ServiceManager\ServiceManager;
 use DanhMuc\Service\DanhMucService; 

 class IndexController extends AbstractActionController
 {
     private $entityManager;
//
     private $eventManager;
//

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

          //Phát sự kiện/ cách 2  
        $DanhMucServiceEvents=$this->getServiceLocator()->get('danh_muc_service');
        //$DanhMucServiceEvents->phatEvent($this);

          //Phần Xóa nhiều lựa chọn
          $request = $this->getRequest();
          if($request->isPost()) 
            {
                $chkId = $request->getPost('chk');
                if($request->getPost('del'))
                {
                    if($chkId!=null)
                    {                
                        foreach($chkId as $id) 
                        {
                            $delId= $objectManager->getRepository('DanhMuc\Entity\DanhMuc')->find($id);
                            $objectManager->remove($delId);
                            $objectManager->flush();
                        }
                        //$DanhMucServiceEvents->xoaEV($this);
                    }
                }                
            } 
            //Hết phần Xóa nhiều lựa chọn

          $danhmucs=$objectManager->getRepository('DanhMuc\Entity\DanhMuc')->findAll();//bỏ findAll nếu sử dụng phân trang

        /* Sử dụng trong phân trang
        $queryBuilder = $danhmucs->createQueryBuilder('dm');//giong as

        $adapter = new DoctrineAdapter(new ORMPaginator($queryBuilder));
        
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(5);     
        $page = (int)$this->params('page');
        if($page) 
            $paginator->setCurrentPageNumber($page);        
        return array(
            'paginator' => $paginator);
        */

        //Gọi plugin
         $plugin = $this->MyPlugin();
         $danhmucs=$plugin->xuatMenu($danhmucs, $root=null);
        //       
         
        //Phát sự kiện/ cách 1
         //$this->getEventManager()->trigger('vd',$this);//Phát sự kiện
        
         return array('danhMucs'=>$danhmucs);//Nếu sử dụng phân trang thì ko dùng

        //Thêm: liên quan tới phân quyền
        if(!$this->zfcUserAuthentication()->hasIdentity())
        {
            return $this->redirect()->toRoute('danh_muc');
        }
        //</>Thêm   

     }

     public function addAction()
     {
         $objectManager=$this->getEntityManager();
         $danhMuc=new DanhMuc();
         $form=new DanhMucForm($objectManager);
         $form->bind($danhMuc);

         $request = $this->getRequest();
         if ($request->isPost()) {     
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());
            
             if ($form->isValid()) {
               $objectManager->persist($danhMuc);
               $objectManager->flush();

               return $this->redirect()->toRoute('danh_muc');
             }
         }
         $DanhMucServiceEvents=$this->getServiceLocator()->get('danh_muc_service');
         $DanhMucServiceEvents->phatEvent($this);
         return array('form' => $form);         
     }

     public function editAction()
     {        
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('danh_muc', array(
                 'action' => 'add'
             ));
         }

         $objectManager=$this->getEntityManager();
         $danhMuc= $objectManager->getRepository('DanhMuc\Entity\DanhMuc')->find($id);
         $form=new SuaDanhMucForm($objectManager,$id);//Thêm mới                          
         
         $form->bind($danhMuc);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             //$form->setInputFilter($album->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {                
                  $objectManager->flush();

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('danh_muc');
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
             return $this->redirect()->toRoute('danh_muc');
         }

         $objectManager=$this->getEntityManager();
         $danhMuc= $objectManager->getRepository('DanhMuc\Entity\DanhMuc')->find($id);
         $form=new DanhMucForm($objectManager);

         //Kiểm tra danhMuc có tồn tại
         if(!$danhMuc)
         {
            return $this->redirect()->toRoute('danh_muc');
         }
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');

                 $objectManager->remove($danhMuc);
                 $objectManager->flush();
             }

             // Redirect to list of albums
             return $this->redirect()->toRoute('danh_muc');
         }

         return array(
             'id'    => $id,
             'danhMuc' => $danhMuc,
         );
     }     
 }