<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommandeProduit
 *
 * @ORM\Table(name="ligne_commande_produit", indexes={@ORM\Index(name="fk_commande_livraison", columns={"id_livraison"}), @ORM\Index(name="fk_commande_produit", columns={"id_produit"})})
 * @ORM\Entity
 */
class LigneCommandeProduit
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
     * @var \Livraison
     *
     * @ORM\ManyToOne(targetEntity="Livraison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_livraison", referencedColumnName="id")
     * })
     */
    private $idLivraison;

<<<<<<< HEAD
=======
    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_produit", referencedColumnName="id")
     * })
     */
    private $idProduit;

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

=======
>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getIdLivraison(): ?Livraison
    {
        return $this->idLivraison;
    }

    public function setIdLivraison(?Livraison $idLivraison): self
    {
        $this->idLivraison = $idLivraison;

        return $this;
    }

<<<<<<< HEAD
=======
    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11

}
