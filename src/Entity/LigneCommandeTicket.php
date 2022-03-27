<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommandeTicket
 *
 * @ORM\Table(name="ligne_commande_ticket", indexes={@ORM\Index(name="fk_livraison1_commande", columns={"id_livraison"}), @ORM\Index(name="fk_ticket_commande", columns={"id_ticket"})})
 * @ORM\Entity
 */
class LigneCommandeTicket
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

    /**
     * @var \Ticket
     *
     * @ORM\ManyToOne(targetEntity="Ticket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ticket", referencedColumnName="id")
     * })
     */
    private $idTicket;


}
