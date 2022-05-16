<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Joueur
 *
 * @ORM\Table(name="joueur", indexes={@ORM\Index(name="fk_joueur_equipe", columns={"equipe_id"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\JoueurRepository")

 */
class Joueur
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
     *@Assert\NotBlank(message="Champ vide")
     * @Assert\NotNull(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer un nom au mini de 2 caracteres"
     *
     *     )
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *@Assert\NotBlank(message="Champ vide")
     * @Assert\NotNull(message=" prenom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un prenom au mini de 2 caracteres"
     *
     *     )
     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *@Assert\NotBlank(message="Champ vide")
     * @Assert\NotNull(message=" poste doit etre non vide")
     * @Assert\Length(
     *      min =1,
     *      minMessage=" Entrer un poste au mini de 2 caracteres"
     *
     *     )
     * @ORM\Column(name="poste", type="string", length=30, nullable=false)
     */
    private $poste;

    /**
     * @var int
     *@Assert\NotBlank(message="Champ vide")
     * @Assert\NotNull(message=" poste doit etre non vide")
     * @Assert\Length(
     *      min =8,
     *      minMessage=" Entrer un tel de 8 caracteres"
     *
     *     )
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    private $tel;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     * })
     */
    private $equipe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_but;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

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

    public function getEquipe()
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
    public function getnb_But(): ?int
    {
        return $this->nb_but;
    }

    public function setnb_But(?int $nb_but): self
    {
        $this->nb_but = $nb_but;

        return $this;
    }

    public function getNbBut(): ?int
    {
        return $this->nb_but;
    }

    public function setNbBut(?int $nb_but): self
    {
        $this->nb_but = $nb_but;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
