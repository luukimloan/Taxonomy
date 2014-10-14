<?php namespace Test\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Test\Entity\Test;
use Zend\ServiceManager\ServiceManager;

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
        //return new ViewModel();
         $objectManager=$this->getEntityManager();

         $tests=$objectManager->getRepository('Test\Entity\Test')->findAll();

         return array('tests_return'=>$tests);
    }
}
