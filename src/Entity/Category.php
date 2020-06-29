<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Idea", mappedBy="category")
     */
    private $ideas;

    /**
     * @return ArrayCollection
     */
    public function getIdeas(): ArrayCollection
    {
        return $this->ideas;
    }

    public function addIdeas(Idea $idea): self
    {
        if (!$this->posts->contains($idea)) {
            $this->ideas[] =$idea;
            $idea->setIdea($this);
        }

        return $this;
    }
    public function setIdeas(ArrayCollection $ideas): void
    {
        $this->ideas = $ideas;
    }

    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
