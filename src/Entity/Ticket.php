<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket", indexes={@ORM\Index(name="fk_match_ticket", columns={"match_id"}), @ORM\Index(name="fk_ticket_user", columns={"user_id"})})
 * @ORM\Entity
 */
class Ticket
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
     * @ORM\Column(name="equipeA", type="string", length=30, nullable=false)
     */
    private $equipea;

    /**
     * @var string
     *
     * @ORM\Column(name="equipeB", type="string", length=30, nullable=false)
     */
    private $equipeb;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipea(): ?string
    {
        return $this->equipea;
    }

    public function setEquipea(string $equipea): self
    {
        $this->equipea = $equipea;

        return $this;
    }

    public function getEquipeb(): ?string
    {
        return $this->equipeb;
    }

    public function setEquipeb(string $equipeb): self
    {
        $this->equipeb = $equipeb;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString()
    {
        return $this->user;

    }






}
