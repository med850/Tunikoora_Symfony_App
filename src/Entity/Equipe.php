<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity
 */
class Equipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Champ vide")
     * @Assert\NotNull(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer un nom au mini de 2 caracteres"
     *
     *     )
     * 
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var int
     * @Assert\Positive
     * @Assert\NotBlank(message="classement doit etre non vide")
     * @Assert\Length(
     *      min = 1,
     *      max = 25,
     *      minMessage = "doit etre >=1 ",
     *      maxMessage = "doit etre <=25" )
     * 
     *
     * @ORM\Column(name="classement", type="integer", nullable=false)
     */
    private $classement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(?int $classement): self
    {
        $this->classement = $classement;

        return $this;
    }


}
