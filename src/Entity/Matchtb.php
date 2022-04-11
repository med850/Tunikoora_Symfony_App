<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matchtb
 *
 * @ORM\Table(name="matchtb")
 * @ORM\Entity
 */
class Matchtb
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
     *
     * @ORM\Column(name="localisation", type="string", length=50, nullable=false)
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="arbitrePrincipale", type="string", length=50, nullable=false)
     */
    private $arbitreprincipale;

    /**
     * @var string
     *
     * @ORM\Column(name="tour", type="string", length=50, nullable=false)
     */
    private $tour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getArbitreprincipale(): ?string
    {
        return $this->arbitreprincipale;
    }

    public function setArbitreprincipale(string $arbitreprincipale): self
    {
        $this->arbitreprincipale = $arbitreprincipale;

        return $this;
    }

    public function getTour(): ?string
    {
        return $this->tour;
    }

    public function setTour(string $tour): self
    {
        $this->tour = $tour;

        return $this;
    }


}
