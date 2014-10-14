<?php
namespace DanhMuc\Service;

use ZfcBase\EventManager\EventProvider;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class DanhMucService extends EventProvider implements ServiceManagerAwareInterface
{
	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->serviceManager=$serviceManager;
		return $this;
	}

	public function phatEvent($target)
	{
		$this->getEventManager()->trigger(__FUNCTION__, $target);
	}

	public function xoaEV($target)
	{
		$this->getEventManager()->trigger(__FUNCTION__, $target);
	}
}
?>