<?php
namespace Album2\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="album")
*/
class Album
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
	private $artist;
	/**
	 * @ORM\Column
	 */
	private $title;

	public function setId($id)
	{
		$this->id=$id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setArtist($artist)
	{
		$this->artist=$artist;
	}

	public function getArtist()
	{
		return $this->artist;
	}

	public function setTitle($title)
	{
		$this->title=$title;	
	}

	public function getTitle()
	{
		return $this->title;	
	}
}
?>