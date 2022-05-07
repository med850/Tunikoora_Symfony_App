<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;

/**
 * Review
 *
 * @ORM\Table(name="review", indexes={@ORM\Index(name="fk_article_review", columns={"article_id"}), @ORM\Index(name="fk_user_review", columns={"user_id"})})
 * @ORM\Entity
 */
class Review
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
     * @Assert\NotBlank(message="commentaire doit etre non vide")
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "doit etre <=100" )
     * @ProfanityAssert\ProfanityCheck
     * @ORM\Column(name="commentaire", type="text", length=65535, nullable=false)
     */
    private $commentaire;



    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comment")
     */
    private $article;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateReview;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getDateReview(): ?\DateTimeInterface
    {
        return $this->dateReview;
    }

    public function setDateReview(?\DateTimeInterface $dateReview): self
    {
        $this->dateReview = $dateReview;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }




}