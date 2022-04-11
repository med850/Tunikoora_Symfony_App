<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
* Users
*
* @ORM\Table(name="users")
* @ORM\Entity
* @UniqueEntity(fields={"email"}, message="Email exist déjà")
*/
class Users implements UserInterface
{
// const ROLE_ADMIN='ROLE_ADMIN';

public function __construct() {
//$this->roles[]= 'ROLE_USER';
$this->typeuser="client";
}
/**
* @var int
*
* @ORM\Column(name="id", type="integer", nullable=false)
* @ORM\Id
* @ORM\GeneratedValue(strategy="IDENTITY")
*/
private $id;
/**
* @var int
*
* @ORM\Column(name="cin", type="integer", nullable=false)
* @Assert\NotBlank(message="Champ vide")
* @Assert\Positive(message="Nombre négatif")
*/
private $cin;

/**
* @var string
*
* @ORM\Column(name="prenom", type="string", length=30, nullable=false)
* @Assert\NotBlank(message="Champ vide")
*/
private $prenom;
/**
* @var int
*
* @ORM\Column(name="tel", type="integer", nullable=false)
* @Assert\NotBlank(message="Champ vide")
* @Assert\Positive(message="Nombre négatif")
*/
private $tel;
/**
* @var string
*
* @ORM\Column(name="email", type="string", length=30, nullable=false)
* @Assert\Email(
* message = "email '{{ value }}' n'est pas valide."
* )
* @Assert\NotBlank(message="Champ vide")
*/
private $email;
/**
* @var string
*
* @ORM\Column(name="password", type="text", length=30, nullable=false)
* @Assert\Length(min = 8, minMessage = "Le mot de passe doit faire minimum 8 caractère ")
* @Assert\EqualTo(propertyPath="repeatpassword", message="Mot de passe non compatible")
* @Assert\NotBlank(message="Champ vide")
*/
private $password;
/**
* @var string
*
* @ORM\Column(name="repeatPassword", type="text", length=30, nullable=false)
* @Assert\Length(min = 8, minMessage = "Le mot de passe doit faire minimum 8 caractère ")
* @Assert\EqualTo(propertyPath="password", message="Confirmation non compatible avec le mot de passe")
* @Assert\NotBlank(message="Champ vide")
*/
private $repeatpassword;
/**
* @var string
*
* @ORM\Column(name="typeUser", type="string", length=7, nullable=false, options={"default" : "client"})
*/
private $typeuser;
/**
* @ORM\Column(type="string", length=20)
*/
private $username;
/**
* @ORM\Column(type="array")
*/
private $roles = [];


public function getId(): ?int
{
return $this->id;
}
public function getCin(): ?int
{
return $this->cin;
}
public function setCin(int $cin): self
{
$this->cin = $cin;
return $this;
}

public function getPrenom(): ?string
{
return $this->prenom;
}
public function setPrenom(string $prenom): self
{
$this->prenom = $prenom;
return $this;
}
public function getTel(): ?int
{
return $this->tel;
}
public function setTel(int $tel): self
{
$this->tel = $tel;
return $this;
}
public function getEmail(): ?string
{
return $this->email;
}
public function setEmail(string $email): self
{
$this->email = $email;
return $this;
}
public function getPassword(): ?string
{
return $this->password;
}
public function setPassword(string $password): self
{
$this->password = $password;
return $this;
}
public function getRepeatpassword(): ?string
{
return $this->repeatpassword;
}
public function setRepeatpassword(string $repeatpassword): self
{
$this->repeatpassword = $repeatpassword;
return $this;
}
public function getTypeuser(): ?string
{
return $this->typeuser;
}
public function setTypeuser(string $typeuser): self
{
$this->typeuser = $typeuser;
return $this;
}
public function getUsername(): ?string
{
return $this->username;
}
public function setUsername(string $username): self
{
$this->username = $username;
return $this;
}


public function getSalt(){}
public function eraseCredentials(){}

public function getRoles():array
{
$roles=$this->roles;
$roles[]='ROLE_USER';
return array_unique($roles);
}
public function setRoles(array $roles){
$this->roles=$roles;
return $this;
}


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }




}
