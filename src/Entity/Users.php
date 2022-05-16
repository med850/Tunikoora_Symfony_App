<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
* Users
*
* @ORM\Table(name="users")
* @ORM\Entity
* @UniqueEntity(fields={"email"}, message="Email exist déjà")
*@ORM\Entity(repositoryClass="App\Repository\UsersRepository")
*/
class Users implements UserInterface
{
// const ROLE_ADMIN='ROLE_ADMIN';

public function __construct() {
//$this->roles[]= 'ROLE_USER';
$this->typeuser="client";
$this->sent = new ArrayCollection();
$this->recived = new ArrayCollection();
}
/**
* @var int
*
* @ORM\Column(name="id", type="integer", nullable=false)
* @ORM\Id
* @ORM\GeneratedValue(strategy="IDENTITY")
* @Groups("post:read")
*/
private $id;
/**
* @var int
*
* @ORM\Column(name="cin", type="integer", nullable=false)
* @Assert\NotBlank(message="Champ vide")
* @Assert\Positive(message="Nombre négatif")
* @Groups("post:read")
*/
private $cin;

/**
* @var string
*
* @ORM\Column(name="prenom", type="string", length=30, nullable=false)
* @Assert\NotBlank(message="Champ vide")
* @Groups("post:read")
*/
private $prenom;
/**
* @var int
*
* @ORM\Column(name="tel", type="integer", nullable=false)
* @Assert\NotBlank(message="Champ vide")
* @Assert\Positive(message="Nombre négatif")
* @Groups("post:read")
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
* @Groups("post:read")
*/
private $email;
/**
* @var string
*
* @ORM\Column(name="password", type="text", length=30, nullable=false)
*/
private $password;
/**
* @var string
*
* @ORM\Column(name="repeatPassword", type="text", length=30, nullable=false)
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
* @Groups("post:read")
*/
private $username;
/**
* @ORM\Column(type="json")
*/
private $roles = [];

/**
 * @ORM\Column(type="boolean", nullable=true)
 */
private $block;

/**
 * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="sender", orphanRemoval=true)
 */
private $sent;

/**
 * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="recipient", orphanRemoval=true)
 */
private $recived;



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

public function getBlock(): ?bool
{
    return $this->block;
}

public function setBlock(?bool $block): self
{
    $this->block = $block;

    return $this;
}

/**
 * @return Collection<int, Messages>
 */
public function getSent(): Collection
{
    return $this->sent;
}

public function addSent(Messages $sent): self
{
    if (!$this->sent->contains($sent)) {
        $this->sent[] = $sent;
        $sent->setSender($this);
    }

    return $this;
}

public function removeSent(Messages $sent): self
{
    if ($this->sent->removeElement($sent)) {
        // set the owning side to null (unless already changed)
        if ($sent->getSender() === $this) {
            $sent->setSender(null);
        }
    }

    return $this;
}

/**
 * @return Collection<int, Messages>
 */
public function getRecived(): Collection
{
    return $this->recived;
}

public function addRecived(Messages $recived): self
{
    if (!$this->recived->contains($recived)) {
        $this->recived[] = $recived;
        $recived->setRecipient($this);
    }

    return $this;
}

public function removeRecived(Messages $recived): self
{
    if ($this->recived->removeElement($recived)) {
        // set the owning side to null (unless already changed)
        if ($recived->getRecipient() === $this) {
            $recived->setRecipient(null);
        }
    }

    return $this;
}

public function __toString(): string
    {
        return $this->id;
    }

}
