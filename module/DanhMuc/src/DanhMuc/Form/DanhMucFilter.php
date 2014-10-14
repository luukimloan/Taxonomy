<?php
namespace DanhMuc\Form;
use Zend\InputFilter\InputFilter;

class DanhMucFilter extends InputFilter{
	public function __construct()
	{
		$this->add(array(
			'name'=>'ten',
			'required'=>true
			));

		$this->add(array(
			'name'=>'moTa',
			'required'=>false
			));

		$this->add(array(
			'name'=>'cha',
			'required'=>false
			));
	}
}
?>