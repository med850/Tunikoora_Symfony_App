<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dislike
 *
 * @ORM\Table(name="dislike", indexes={@ORM\Index(name="fk_dislike_article", columns={"article_id"}), @ORM\Index(name="fk_user_dislike", columns={"user_id"})})
 * @ORM\Entity
 */
class Dislike
{
    /**
     * @var int
     *
     * @ORM\Column(name="dislikes", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dislikes;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
