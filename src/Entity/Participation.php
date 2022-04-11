<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_participation_equipe", columns={"equipe_id"}), @ORM\Index(name="fk_participation_match", columns={"match_id"})})
 * @ORM\Entity
 */
class Participation
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
     * @var \Matchtb
     *
     * @ORM\ManyToOne(targetEntity="Matchtb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="match_id", referencedColumnName="id")
     * })
     */
    private $match;

<<<<<<< HEAD
=======
    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     * })
     */
    private $equipe;

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

=======
>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11
    public function getMatch(): ?Matchtb
    {
        return $this->match;
    }

    public function setMatch(?Matchtb $match): self
    {
        $this->match = $match;

        return $this;
    }

<<<<<<< HEAD
=======
    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

>>>>>>> bddbe57af83d20bd1d4b7333a95e8d512581cf11

}
