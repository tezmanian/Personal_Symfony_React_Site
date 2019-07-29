<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EducationRepository")
 */
class Education
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"education"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"education"})
     */
    private $institute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"education"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"education"})
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"education"})
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"education"})
     */
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstitute(): ?string
    {
        return $this->institute;
    }

    public function setInstitute(string $institute): self
    {
        $this->institute = $institute;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
