<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use symfony\component\validator\Constraints as Assert;


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
     * @Assert\NotBlank(message="localisation  doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      max = 25,
     *      minMessage = "doit etre >=4 ",
     *      maxMessage = "doit etre <=25" )
     * @ORM\Column(type="string", length=25)
     */
    private $localisation;
/**
     * @Assert\NotBlank(message="arbitrePrincipal  doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      max = 25,
     *      minMessage = "doit etre >=4 ",
     *      maxMessage = "doit etre <=25" )
     * @ORM\Column(type="string", length=25)
     */
    private $arbitreprincipale;

    /**
     * @Assert\NotBlank(message="le tour  doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      max = 25,
     *      minMessage = "doit etre >=4 ",
     *      maxMessage = "doit etre <=25" )
     * @ORM\Column(type="string", length=25)
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
