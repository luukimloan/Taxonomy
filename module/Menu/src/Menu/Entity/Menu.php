<?php
namespace Menu\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="menu")
*/
class Menu
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
	 * @ORM\Column(name="dinh_tuyen")
	 */
	private $dinhTuyen;

	/**
	 * @ORM\Column(name="tham_so", type="text")
	 */
	private $thamSo;	

	/**
	 * @ORM\Column
	 */
	private $loai;
	

	/**	 
	 * @ORM\ManyToOne(targetEntity="Menu")
	 * @ORM\JoinColumn(name="cha", referencedColumnName="id")
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

	public function setDinhTuyen($dinhTuyen)
	{
		$this->dinhTuyen=$dinhTuyen;
	}

	public function getDinhTuyen()
	{
		return $this->dinhTuyen;
	}


	public function setThamSo($thamSo)
	{
		$this->thamSo=$thamSo;
	}

	public function getThamSo()
	{
		return $this->thamSo;
	}

	public function setCha($cha)
	{
		$this->cha=$cha;	
	}

	public function getCha()
	{
		return $this->cha;	
	}

	

	public function setLoai($loai)
	{
		$this->loai=$loai;	
	}

	public function getLoai()
	{
		return $this->loai;
	}

	public function getTenCha()
	{
		$cha=$this->cha;
		if($cha)
			return $cha->getTen();
			//var_dump($cha);
	}
}
?>