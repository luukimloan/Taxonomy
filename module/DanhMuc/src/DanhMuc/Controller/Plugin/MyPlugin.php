<?php
namespace DanhMuc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class MyPlugin extends AbstractPlugin
{
	private $level=0;
	private $mang=array();
//Xây dựng hàm xuất menu theo cây thư mục
	public function xuatMenu($tree, $root=null)
	{		
		foreach ($tree as $i=>$child)
        {
            $parent=$child->getCha();
                         
            if($parent==$root)
             {                	
                 unset($tree[$i]);
                 $child->setCap($this->level);
                 $this->mang[]=$child;
                 $this->level++;
                 $this->xuatMenu($tree,$child);
                 $this->level--;
            }
       }
       //var_dump($this->mang);
        return $this->mang;		
	}
}
?>