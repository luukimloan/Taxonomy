<?php
namespace DanhMuc\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Persistence\PersistentObject;
/**
* @ORM\Entity
* @ORM\Table(name="danh_muc")
*/
class DanhMuc
{
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue
	*/	
	private $id;

	/**
	 * @ORM\OneToMany(targetEntity="DanhMuc",mappedBy="cha",cascade={"persist","remove"})
	 */
	private $cons;

	/**	 
	 *@ORM\ManyToOne(targetEntity="DanhMuc",inversedBy="cons")
	 *@ORM\JoinColumn(name="cha", referencedColumnName="id")
	 */
	private $cha;

	/**
	 * @ORM\Column
	 */
	private $ten;

	/**
	 * @ORM\Column(name="mo_ta",type="text")
	 */

	private $moTa;	


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

	private $cap;
	public function setCap($cap)
	{
		$this->cap=$cap;
	}

	public function getCap()
	{
		return $this->cap;
	}
}
?>