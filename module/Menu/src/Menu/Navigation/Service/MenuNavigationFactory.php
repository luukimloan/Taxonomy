<?php

namespace Menu\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Menu\Entity\Menu;

class MenuNavigationFactory extends DefaultNavigationFactory
{
	protected function getName()
	{
		return 'menu';
	}

	protected function getPages(ServiceLocatorInterface $sevicelocator)	
	{
		$objectManager=$serviceLocator->get();
	}
}