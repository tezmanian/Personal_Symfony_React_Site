<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AboutRepository")
 */
class About
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"about"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"about"})
     */
    private $heading;

    /**
     * @ORM\Column(type="text")
     * @Groups({"about"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AboutItem", mappedBy="about", orphanRemoval=true)
     * @Groups({"about"})
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function setHeading(?string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|AboutItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(AboutItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setAbout($this);
        }

        return $this;
    }

    public function removeItem(AboutItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getAbout() === $this) {
                $item->setAbout(null);
            }
        }

        return $this;
    }
}
