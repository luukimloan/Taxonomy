<?php
namespace DanhMuc\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
use DanhMuc\Entity\DanhMuc;
//Để sử dụng được Navigation phải kb service_manager trong config
class DanhMucNavigationFactory extends DefaultNavigationFactory{
	protected function getName(){
		return 'danh_muc';//Phần service_manager, file module.config.php
	}

	protected function getPages(ServiceLocatorInterface $serviceLocator){
		$objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
		$dms = $objectManager->getRepository('DanhMuc\Entity\DanhMuc')->findAll();

		if (null === $this->pages) {   
            $config = $this->parseTree($dms);

        //    $config = array();
            
            $pages       = $this->getPagesFromConfig($config);
            $this->pages = $this->preparePages($serviceLocator, $pages);
        }
        return $this->pages;
	}

    private $level=0;

    public function parseTree($tree, $root = null) {
        $return = array();
        foreach($tree as $i=>$child) {
            $parent = $child->getCha();
            if($parent == $root) {
                unset($tree[$i]);
                $this->level++;
                $pages = $this->parseTree($tree, $child);
                if($pages)
                    $return[] = array(
                        'label' => ($this->level==1)? $child->getTen().'<span class="caret"></span>':$child->getTen(),
                        'route' => 'danh_muc',
                        'wrapClass'=>($this->level>1)?'menu-item dropdown dropdown-submenu':'menu-item dropdown',// class to <li>
                        'class'=>'dropdown-toggle',// class to <a> like usual
                        'attribs'   => array(
                        'data-toggle' => 'dropdown',// Key = Attr name, Value = Attr Value
                        ),
                        'pagesContainerClass' => 'dropdown-menu',
                        'params' => array('action'=>'view', 'id'=>$child->getId()),
                        'pages' => $pages,

                    );
                else
                    $return[] = array(
                        'label' => $child->getTen(),
                        'route' => 'danh_muc',
                        'wrapClass'=>'menu-item',// class to <li>
                        'pagesContainerClass' => 'dropdown-menu',
                        'params' => array('action'=>'view', 'id'=>$child->getId()),
                    );
                $this->level--;
            }
        }
        return $return;
    }
}