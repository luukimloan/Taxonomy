<?php

namespace Album\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;

class TrangChuNavigationFactory extends DefaultNavigationFactory
{
	protected function getName()
	{
		return 'trang_chu';
	}
}