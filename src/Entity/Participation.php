<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use symfony\component\validator\Constraints as Assert;

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

  
 

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_id", referencedColumnName="id")
     * })
     */
    private $equipe2;

    /**
     * @var \Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_id2", referencedColumnName="id", nullable=true)
     * })
     */
    private $equipe;
    /**
    * @ORM\Column(name="date", type="datetime_immutable", nullable=true)
 */
    private $date;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getDate(): ?\DatetimeImmutable
    {
        return $this->date;
    }
    public function setDate(?\DatetimeImmutable $date): self
    {
        $this->date = $date;
        return $this;
    }
    public function getMatch()
    {
        return $this->match;
    }

    public function setMatch(?Matchtb $match): self
    {
        $this->match = $match;

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

        public function getEquipe2()
    {
        return $this->equipe2;
    }

    public function setEquipe2(?Equipe $equipe2): self
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    

}
