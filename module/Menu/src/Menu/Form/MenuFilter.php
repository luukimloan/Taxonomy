<?php
namespace Menu\Form;
use Zend\InputFilter\InputFilter;

class MenuFilter extends InputFilter{
	public function __construct()
	{
		$this->add(array(
			'name'=>'ten',
			'required'=>true
			));

		$this->add(array(
			'name'=>'dinhTuyen',
			'required'=>false
			));

		$this->add(array(
			'name'=>'thamSo',
			'required'=>false
			));

		$this->add(array(
			'name'=>'cha',
			'required'=>false
			));

		$this->add(array(
			'name'=>'loai',
			'required'=>false
			));
	}
}
?>