<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
// Component qui me permet de vérifier les données d'un formulaire
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Asserts\Length(min=10, max=255, minMessage="Cette valeur est trop courte. Il doit comporter 10 caractères ou plus.", maxMessage="Cette valeur est trop longue. Il doit comporter 255 caractères ou moins.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Asserts\Length(min=10, minMessage="Cette valeur est trop courte. Il doit comporter 10 caractères ou plus.")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Asserts\Url(message=" Cette valeur n'est pas une URL valide.")
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
