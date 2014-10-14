<?php
namespace DanhMuc\Entity;
use ZfcUser\Entity\UserInterface;
use BjyAuthorize\Provider\Role\ProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="user")
*/
class SystemUser implements UserInterface, ProviderInterface{
	
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue
	*/
	private $id;

	/**
	 * @ORM\Column(name="display_name",length=50)
	 */
	private $name;

	/**
	 * @ORM\Column
	 */
	private $city;

	/**
	 * @ORM\Column(type="date")
	 */
	private $birthday;

	/**
	 * @ORM\Column
	 */
	private $username;

	/**
	 * @ORM\Column(length=128)
	 */
	private $password;

	/**
	 * @ORM\Column
	 */
	private $email;

	/**
	 * @ORM\Column(type="smallint",length=5)
	 */
	private $state;

	/**	 
	 * @ORM\ManyToMany(targetEntity="DanhMuc\Entity\Role")
	 * @ORM\JoinTable(name="user_role_linker",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
	 */	
	private $roles;

	/**
     * Initialies the roles variable.
     */
	public function __construct()
    {  
        $this->roles = new ArrayCollection();
    }

	public function setId($id)
	{
		$this->id=$id;
	}
	public function getId()
	{
		return $this->id;
	}

	
	public function setDisplayName($name)
	{
		$this->name=$name;
	}
	public function getDisplayName()
	{
		return $this->name;
	}


	public function setName($name)
	{
		$this->name=$name;
	}
	public function getName()
	{
		return $this->name;
	}

	
	public function setCity($city)
	{
		$this->city=$city;
	}
	public function getCity()
	{
		return $this->city;
	}

	
	public function setBirthday($birthday)
	{
		$this->birthday=$birthday;
	}
	public function getBirthday()
	{
		return $this->birthday;
	}

	
	public function setUsername($username)
	{
		$this->username=$username;
	}
	public function getUsername()
	{
		return $this->username;
	}

	
	public function setPassword($password)
	{
		$this->password=$password;
	}
	public function getPassword()
	{
		return $this->password;
	}


	public function setEmail($email)
	{
		$this->email=$email;
	}
	public function getEmail()
	{
		return $this->email;
	}


	public function setState($state)
	{
		$this->state=$state;
	}
	public function getState()
	{
		return $this->state;
	}

	public function getRoles()
    {
        return $this->roles->getValues();
    }

	public function addRole($role)
    {
        $this->roles[] = $role;
    }	
}
?>