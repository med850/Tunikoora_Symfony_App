<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panierp
 *
 * @ORM\Table(name="panierp", indexes={@ORM\Index(name="fk_panier_produit", columns={"produit_id"}), @ORM\Index(name="fk_panier_user1", columns={"user_id"})})
 * @ORM\Entity
 */
class Panierp
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPanier", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpanier;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

<<<<<<< HEAD
=======
    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     * })
     */
    private $produit;

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getIdpanier(): ?int
    {
        return $this->idpanier;
    }

<<<<<<< HEAD
    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

=======
>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

<<<<<<< HEAD
=======
    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11

}
