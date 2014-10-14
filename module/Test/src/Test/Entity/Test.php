<?php
namespace Test\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Persistence\PersistentObject;

/**
* @ORM\Entity
* @ORM\Table(name="test")
*/
class Test
{	
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $id;

	/**
	 * @ORM\Column
	 */
	private $ten;

	/**
	 * @ORM\Column(name="mo_ta",type="text")
	 */
	private $moTa;

	/**	 
	 *@ORM\ManyToOne(targetEntity="Test")
	 *@ORM\JoinColumn(name="cha", referencedColumnName="id")
	*/ 
	private $cha;

	public function getId()
	{
		return $this->id;
	}

	public function setTen($ten)
	{
		$this->ten=$ten;
	}

	public function getTen()
	{
		return $this->ten;
	}

	public function setMoTa($moTa)
	{
		$this->moTa=$moTa;
	}

	public function getMoTa()
	{
		return $this->moTa;
	}

	public function setCha($cha)
	{
		$this->cha=$cha;
	}

	public function getCha()
	{
		return $this->cha;	
	}

	public function getTenCha()
	{
		$cha=$this->cha;
		if($cha)
			return $cha->getTen();
	}
}
?>